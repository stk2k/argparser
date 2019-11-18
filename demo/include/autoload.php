<?php
require_once dirname(dirname(__DIR__)). '/vendor/autoload.php';

spl_autoload_register(function ($class)
{
    if (strpos($class, 'Stk2k\\ArgParser\\') === 0) {
        $name = substr($class, strlen('Stk2k\\ArgParser\\'));
        $name = array_filter(explode('\\',$name));
        $file = dirname(dirname(__DIR__)) . '/src/' . implode('/',$name) . '.php';
        /** @noinspection PhpIncludeInspection */
        require_once $file;
    }
});
