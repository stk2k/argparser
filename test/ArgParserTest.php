<?php
namespace Calgamo\Getopt;

use PHPUnit\Framework\TestCase;
use Stk2k\ArgParser\ArgParser;

class ArgParserTest extends TestCase
{
    /**
     * @throws
     */
    public function testParse()
    {
        $args = ArgParser::parse([
            'a', 'b',
        ]);

        $this->assertSame(['a', 'b'], $args);

        $args = ArgParser::parse([
            'a', 'b', '-c'
        ]);

        $this->assertSame(['a', 'b', '-c'=>true], $args);

        $args = ArgParser::parse([
            'a', 'b', '-c', "100"
        ]);

        $this->assertSame(['a', 'b', '-c'=>'100'], $args);

        $args = ArgParser::parse([
            '--a-key=Potato'
        ]);

        $this->assertSame(['--a-key'=> 'Potato'], $args);

        $args = ArgParser::parse([
            '--a-key="Fried Potato"'
        ]);

        $this->assertSame(['--a-key'=> 'Fried Potato'], $args);

        $args = ArgParser::parse([
            '--a-key="(O_@)/~"',                    // ()/~@
        ]);

        $this->assertSame(['--a-key'=> '(O_@)/~'], $args);

        $args = ArgParser::parse([
            '--a-key="[]{}.,"',                    // []{}.,
        ]);

        $this->assertSame(['--a-key'=> '[]{}.,'], $args);

        $args = ArgParser::parse([
            '--a-key="\'#!;:"',                    // '#"!;:
        ]);

        $this->assertSame(['--a-key'=> '\'#!;:'], $args);

        $args = ArgParser::parse([
            '--a-key="*+-&%"',                    // *+-&%
        ]);

        $this->assertSame(['--a-key'=> '*+-&%'], $args);

        $args = ArgParser::parse([
            '--a-key="<>`$?_"',                    // <>`$?_
        ]);

        $this->assertSame(['--a-key'=> '<>`$?_'], $args);
    }
}
