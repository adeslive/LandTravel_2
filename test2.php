<?php

require 'vendor/autoload.php';

use RPF\Core\Result;
use React\EventLoop\Factory;
use Recoil\React\ReactKernel;
use React\MySQL\Factory as MySQLFactory;
use React\MySQL\Io\Query;
use React\MySQL\QueryResult;

use function React\Promise\resolve;

