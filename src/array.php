<?php declare(strict_types=1);

namespace Dryist;

use InvalidArgumentException;

/**
 * Count the number of items.
 *
 * @see https://php.net/iterator_count
 *
 * @param iterable $items
 *
 * @return int
 */
function count(iterable $items): int
{
    $total = 0;
    foreach ($items as $_) {
        $total++;
    }
    return $total;
}

/**
 * Combine a list of keys and a list of values into a map.
 *
 * @param iterable $keys
 * @param iterable $values
 *
 * @return iterable
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

/**
 * Limit items by a predicate applied to value.
 *
 * Example predicate:
 *
 *     function ($value): bool {
 *         return $value > 1;
 *     }
 *
 * @param iterable $items
 * @param callable $accept
 *
 * @return iterable
 */
function filter(iterable $items, callable $accept): iterable
{
    foreach ($items as $key => $item) {
        if ($accept($item)) {
            yield $key => $item;
        }
    }
}

/**
 * Limit items by a predicate applied to key.
 *
 * Example predicate:
 *
 *     function ($key): bool {
 *         return $key % 2 === 0;
 *     }
 *
 * @param iterable $items
 * @param callable $accept
 *
 * @return iterable
 */
function filterKey(iterable $items, callable $accept): iterable
{
    foreach ($items as $key => $item) {
        if ($accept($key)) {
            yield $key => $item;
        }
    }
}

/**
 * Resolve a list of keys from a map.
 *
 * @param iterable $items
 *
 * @return iterable
 */
function keys(iterable $items): iterable
{
    foreach ($items as $key => $value) {
        yield $key;
    }
}

/**
 * Apply a modifier to every item.
 *
 * Example modifier:
 *
 *     function ($value) {
 *         return $value;
 *     }
 *
 * @param iterable $items
 * @param callable $modify
 *
 * @return iterable
 */
function map(iterable $items, callable $modify): iterable
{
    foreach ($items as $key => $value) {
        yield $key => $modify($value);
    }
}

/**
 * Apply a modifier to every item with the key.
 *
 * Example modifier:
 *
 *     function ($key, $value) {
 *         return $value;
 *     }
 *
 * @param iterable $items
 * @param callable $modify
 *
 * @return iterable
 */
function mapBoth(iterable $items, callable $modify): iterable
{
    foreach ($items as $key => $value) {
        yield $key => $modify($key, $value);
    }
}

/**
 * Apply a modifier to every item key.
 *
 * Example modifier:
 *
 *     function ($key) {
 *         return $key;
 *     }
 *
 * @param iterable $items
 * @param callable $modify
 *
 * @return iterable
 */
function mapKey(iterable $items, callable $modify): iterable
{
    foreach ($items as $key => $value) {
        yield $modify($key) => $value;
    }
}

/**
 * Resolve an iterable to an array.
 *
 * @link https://php.net/iterator_to_array
 *
 * @param iterable $items
 *
 * @return array
 */
function resolve(iterable $items): array
{
    if (is_array($items)) {
        return $items;
    }

    return \iterator_to_array($items);
}

/**
 * Limit items in a map by a list of keys.
 *
 * @param iterable $items
 * @param array    $keys
 *
 * @return iterable
 */
function take(iterable $items, array $keys): iterable
{
    return filterKey($items, function ($key) use ($keys): bool {
        return \in_array($key, $keys, true);
    });
}

/**
 * Resolve a map into a list.
 *
 * @param iterable $items
 *
 * @return iterable
 */
function values(iterable $items): iterable
{
    foreach ($items as $value) {
        yield $value;
    }
}
