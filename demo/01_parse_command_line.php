<?php
declare(strict_types=1);

require_once __DIR__ . '/include/autoload.php';

use Stk2k\ArgParser\ArgParser;

try{
    $args = ArgParser::parse(null);
    print_r($args);
}
catch(Throwable $e){
    echo 'ERROR:' . PHP_EOL;
    echo $e->getTraceAsString();
}