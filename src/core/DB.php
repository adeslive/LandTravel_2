<?php

namespace RPF\Core;

use Exception;
use RPF\Core\Result;
use React\MySQL\Factory;
use React\MySQL\QueryResult;
use React\MySQL\Io\Connection;
use React\Cache\CacheInterface;
use React\EventLoop\LoopInterface;

final class DB
{
    /**
     * @var Factory
     */
    private $mysql;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var string
     */
    private $query;

    /**
     * @var array
     */
    private $last_result;

    /**
     * @var array
     */
    private $result;

    /**
     * @var QueryResult
     */
    private $raw_result;


    /**
     * @var CacheInterface
     */
    private $cache;

    const START = 0;
    const EXECUTED = 1;
    const ERROR = 2;


    const URI = "api:apiPassword1@localhost:3306/final";

    public function __construct(LoopInterface $loop, CacheInterface $cache = null, bool $lazy = true)
    {
        $this->mysql = new Factory($loop);
        
        if($lazy){
            $this->connection = $this->mysql->createLazyConnection(DB::URI);
        }else{
            $this->connection = $this->mysql->createConnection(DB::URI);
        }
        
        assert($this->connection->ping());

        $this->result = [];
        $this->cache = $cache;
        $this->sql = "";
        $this->status = DB::START;
    }

    /**
     * Returns the result of a query
     * Cache implementation is due.
     * @return array|string
     */
    public function query(string $sql, array $vars = []) 
    {
        assert(!empty($sql) || $sql != null);
        return $this->connection->query($sql, $vars)
                ->then(
                    function(QueryResult $result) use ($sql){
                        $this->last_result = $this->result;
                        $this->query = $sql;
                        $this->raw_result = $result;
                        $this->result = [];
                        if (!empty($result->resultRows)){
                            foreach($result->resultRows as $row){
                                array_push($this->result, Result::Result($row)->toArray());
                            }
                        }
                        return $this->result;
                    },
                    function(){
                        return array();
                    }
            );
    }

    public function getResult()
    {
        return $this->result;
    }

    public function getLastResult()
    {
        return $this->last_result;
    }

    public function getRawResult()
    {
        return $this->raw_result;
    }
}
