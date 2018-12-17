<?php declare(strict_types=1);

namespace Dryist;

use ArrayIterator;
use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase
{
    public function dataIterables(): array
    {
        return [
            [[1, 2, 3]],
            [(function () {
                yield 1;
                yield 2;
                yield 3;
            })()],
            [new ArrayIterator([1, 2, 3])],
        ];
    }

    /** @dataProvider dataIterables */
    public function testItCanMapIterable(iterable $items): void
    {
        $items = map($items, "strval");

        $this->assertEquals(["1", "2", "3"], resolve($items));
    }

    /** @dataProvider dataIterables */
    public function testItCanMapBothOfIterable(iterable $items): void
    {
        $items = mapBoth($items, function (int $key, int $value) {
            return $key * $value;
        });

        $this->assertEquals([0, 2, 6], resolve($items));
    }

    /** @dataProvider dataIterables */
    public function testItCanMapKeyOfIterable(iterable $items): void
    {
        $items = mapKey($items, function (int $key) {
            return ++$key;
        });

        $this->assertEquals([1, 2, 3], resolve(keys($items)));
    }

    public function testItCanTakeByKeys(): void
    {
        $items = [
            "foo" => "foo",
            "bar" => "bar",
            "baz" => "baz",
        ];

        $this->assertEquals(["foo"], resolve(keys(takeKeys($items, ["foo"]))));
    }

    public function testItCanTakeByValue(): void
    {
        $items = [0, 1, 2, 3, 4];

        $accept = function (int $value): bool {
            return $value % 2 === 0;
        };

        $this->assertEquals([0, 2, 4], resolve(values(take($items, $accept))));
    }
}
