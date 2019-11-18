<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

spl_autoload_register(function ($class)
{
    if (strpos($class, 'Calgamo\\Getopt\\Sample') === 0) {
        $name = substr($class, strlen('Calgamo\\Getopt\\Sample'));
        $name = array_filter(explode('\\',$name));
        $file = dirname(__DIR__) . '/sample/src/' . implode('/',$name) . '.php';
        /** @noinspection PhpIncludeInspection */
        require_once $file;
    }
    else if (strpos($class, 'Calgamo\\Getopt\\') === 0) {
        $name = substr($class, strlen('Calgamo\\Getopt'));
        $name = array_filter(explode('\\',$name));
        $file = dirname(__DIR__) . '/src/' . implode('/',$name) . '.php';
        /** @noinspection PhpIncludeInspection */
        require_once $file;
    }
});