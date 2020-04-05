<?php

namespace RPF\Core;

class Result
{
    protected function __construct(Array $arguments)
    {
       foreach ($arguments as $field => $argument){
           if(!empty($arguments)){
                $this->{$field} = $argument;
           }
       }
    }

    public function toArray()
    {
        return (array) $this;
    }

    public static function Result(array $arguments)
    {
        return new self($arguments);   
    }
}