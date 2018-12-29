<?php declare(strict_types=1);

namespace Dryist;

use InvalidArgumentException;

/**
 * Count the number of items.
 *
 * @see https://php.net/iterator_count
 */
function count(iterable $items): int
{
    $total = 0;
    foreach ($items as $_) {
        $total++;
    }
    return $total;
}
const count = '\Dryist\count';

/**
 * Combine a list of keys and a list of values into a map.
 */
function combine(iterable $keys, iterable $values): iterable
{
    if (count($keys) !== count($values)) {
        throw new InvalidArgumentException("Count of keys and values do not match");
    }

    foreach ($keys as $key) {
        yield $key => \current($values);
        \next($values);
    }
}
const combine = '\Dryist\combine';

/**
 * Limit items by a predicate applied to value.
 *
 * Example predicate:
 *
 *     function ($value): bool {
 *         return $value > 1;
 *     }
 */
function filter(iterable $items, callable $accept): iterable
{
    foreach ($items as $key => $item) {
        if ($accept($item)) {
            yield $key => $item;
        }
    }
}
const filter = '\Dryist\filter';

/**
 * Limit items by a predicate applied to key.
 *
 * Example predicate:
 *
 *     function ($key): bool {
 *         return $key % 2 === 0;
 *     }
 */
function filterKey(iterable $items, callable $accept): iterable
{
    foreach ($items as $key => $item) {
        if ($accept($key)) {
            yield $key => $item;
        }
    }
}
const filterKey = '\Dryist\filterKey';

/**
 * Resolve a list of keys from a map.
 */
function keys(iterable $items): iterable
{
    foreach ($items as $key => $value) {
        yield $key;
    }
}
const keys = '\Dryist\keys';

/**
 * Apply a modifier to every item.
 *
 * Example modifier:
 *
 *     function ($value) {
 *         return $value;
 *     }
 */
function map(iterable $items, callable $modify): iterable
{
    foreach ($items as $key => $value) {
        yield $key => $modify($value);
    }
}
const map = '\Dryist\map';

/**
 * Apply a modifier to every item with the key.
 *
 * Example modifier:
 *
 *     function ($key, $value) {
 *         return $value;
 *     }
 */
function mapBoth(iterable $items, callable $modify): iterable
{
    foreach ($items as $key => $value) {
        yield $key => $modify($key, $value);
    }
}
const mapBoth = '\Dryist\mapBoth';

/**
 * Apply a modifier to every item key.
 *
 * Example modifier:
 *
 *     function ($key) {
 *         return $key;
 *     }
 */
function mapKey(iterable $items, callable $modify): iterable
{
    foreach ($items as $key => $value) {
        yield $modify($key) => $value;
    }
}
const mapKey = '\Dryist\mapKey';

/**
 * Resolve an iterable to an array.
 *
 * @link https://php.net/iterator_to_array
 */
function resolve(iterable $items): array
{
    if (is_array($items)) {
        return $items;
    }

    return \iterator_to_array($items);
}
const resolve = '\Dryist\resolve';

/**
 * Limit items in a map by a list of keys.
 */
function take(iterable $items, array $keys): iterable
{
    return filterKey($items, function ($key) use ($keys): bool {
        return \in_array($key, $keys, true);
    });
}
const take = '\Dryist\take';

/**
 * Resolve a map into a list.
 */
function values(iterable $items): iterable
{
    foreach ($items as $value) {
        yield $value;
    }
}
const values = '\Dryist\values';
