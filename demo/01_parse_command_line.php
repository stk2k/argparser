<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use stk2k\argparser\ArgParser;

try{
    $args = ArgParser::parse();
    print_r($args);
}
catch(Throwable $e){
    echo 'ERROR:' . PHP_EOL;
    echo $e->getTraceAsString();
}