<?php

namespace RPF\Builders;

use React\EventLoop\LoopInterface;
use React\MySQL\Io\Connection;

final class QueryBuilder
{
    private $connection;
    private $loop;

    public function __construct(Connection $connection, LoopInterface $loop)
    {
        $this->connection = $connection;
        $this->loop = $loop;
    }
}
