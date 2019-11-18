Parser for command line options
=======================

[![Latest Version on Packagist](https://img.shields.io/packagist/v/stk2k/argparser.svg?style=flat-square)](https://packagist.org/packages/stk2k/argparser)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/stk2k/argparser.svg?branch=master)](https://travis-ci.org/stk2k/argparser)
[![Coverage Status](https://coveralls.io/repos/github/stk2k/argparser/badge.svg?branch=master)](https://coveralls.io/github/stk2k/argparser?branch=master)
[![Code Climate](https://codeclimate.com/github/stk2k/argparser/badges/gpa.svg)](https://codeclimate.com/github/stk2k/argparser)
[![Total Downloads](https://img.shields.io/packagist/dt/stk2k/argparser.svg?style=flat-square)](https://packagist.org/packages/stk2k/argparser)

## Description

Parser for command line options

## Feature

- No need to setup complex configuration
- short options: -abc means a/b/c switches(returns [a=>true, b=>true, c=>true])
- long options: --a-key value/--a-key=value returns associative array(['a-key'=>value])
- ordered options: "command a b c" returns ordered array([a, b, c])

## Description

```php
ArgParser::parse(array $args = null, array $required =[], array $defaults = []);
```

### Parameters

| arg name       | explain |
| ---------------|----------------|
| $args          | specify arguments(if omitted, global $argv is used) |
| $required      | specify required options |
| $defaults      | specify option default values |

## Demo

### [01] Parse command line

```php
$args = ArgParser::parse(null);     // script.php a b -c --favorite-food="Fried potato"
print_r($args);
//Array
//(
//    [0] => /path/to/script.php
//    [1] => a
//    [2] => b
//    [-c] => 1
//    [--favorite-food] => Fried potato
//)
```

## Requirement

PHP 7.1 or later

## Installing stk2k/argparser

The recommended way to install stk2k/argparser is through
[Composer](http://getcomposer.org).

```bash
composer require stk2k/argparser
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

## License
[MIT](https://github.com/stk2k/argparser/blob/master/LICENSE)

## Author

[stk2k](https://github.com/stk2k)

## Disclaimer

This software is no warranty.

We are not responsible for any results caused by the use of this software.

Please use the responsibility of the your self.

