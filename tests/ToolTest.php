<?php declare(strict_types=1);

namespace Dryist;

use ArrayIterator;
use PHPUnit\Framework\TestCase;

class ToolTest extends TestCase
{
    public function testMake(): void
    {
        $values = [[1, 2, 3]];
        $values = map($values, make(ArrayIterator::class));
        $values = resolve($values);

        $this->assertTrue(count($values) === 1);
        $this->assertCount(3, $values[0]);
        $this->assertInstanceOf(ArrayIterator::class, $values[0]);
    }
}
