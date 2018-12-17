<?php declare(strict_types=1);

namespace Dryist;

use PHPUnit\Framework\TestCase;

class AlgebraTest extends TestCase
{
    public function testItCanIdentify(): void
    {
        $x = rand();

        $this->assertEquals($x, id($x));
    }

    public function testItCanConstant(): void
    {
        $fn = always($value = rand());

        $this->assertEquals($value, $fn(rand()));
    }

    public function testItCanSubstitute(): void
    {
        $value = "HELLO, WORLD";

        $this->assertEquals("Hello, world", compose("ucfirst", "strtolower")($value));
    }
}
