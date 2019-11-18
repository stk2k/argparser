<?php
declare(strict_types=1);

namespace Stk2k\ArgParser;

use InvalidArgumentException;

use Stk2k\ArgParser\Exception\OptionValueRequiredException;

final class ArgParser
{
    /**
     * Parse command line args
     *
     * @param array|null $args
     * @param array $required
     * @param array $defaults
     *
     * @return array
     *
     * @throws OptionValueRequiredException
     */
    public static function parse(array $args = null, array $required = [], array $defaults = []) : array
    {
        if (!$args){
            global $argv;

            $args = $argv;
        }

        $parsed = [];
        $key = null;
        foreach($args as $arg)
        {
            if (!is_string($arg)){
                throw new InvalidArgumentException('Type of each arguments must be string.');
            }
            if (preg_match('/^--([\w\-]+)="?([!\s\x23-\x7E]+)"?$/', $arg, $matches)){
                // long option with value(--a-key=value)
                if ($key){
                    if (in_array($key, $required)){
                        throw new OptionValueRequiredException('Option requires value: ' . $key);
                    }
                    $parsed[$key] = $defaults[$key] ?? true;
                    $key = null;
                }

                $key = '--' . $matches[1];
                $parsed[$key] = $matches[2];
                $key = null;
            }
            else if (preg_match('/^--([\w\-]+)$/', $arg, $matches)){
                // long option
                if ($key){
                    if (in_array($key, $required)){
                        throw new OptionValueRequiredException('Option requires value: ' . $key);
                    }
                    $parsed[$key] = $defaults[$key] ?? true;
                    $key = null;
                }

                $key = '--' . $matches[1];
            }
            else if (preg_match('/^-([\w\-]+)$/', $arg, $matches)){
                // single or multiple short option
                if ($key){
                    if (in_array($key, $required)){
                        throw new OptionValueRequiredException('Option requires value: ' . $key);
                    }
                    $parsed[$key] = $defaults[$key] ?? true;
                    $key = null;
                }

                $short_options = str_split($matches[1]);

                if (count($short_options) > 1){
                    // multiple short options
                    foreach(str_split('', $short_options) as $opt){
                        $parsed[$opt] = $defaults[$opt] ?? true;

                        if (in_array($opt, $required)){
                            throw new OptionValueRequiredException('Option requires value: ' . $key);
                        }
                    }
                }
                else{
                    $key = '-' . $short_options[0];
                }
            }
            else if ($key){
                // option value
                $parsed[$key] = $arg;
                $key = null;
            }
            else{
                // ordered argument
                $parsed[] = $arg;
            }
        }

        if ($key){
            if (in_array($key, $required)){
                throw new OptionValueRequiredException('Option requires value: ' . $key);
            }
            $parsed[$key] = true;       // no value option
        }

        return $parsed;
    }
}