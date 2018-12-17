<?php declare(strict_types=1);

namespace Dryist;


/**
 * Resolve a list of keys from a map.
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
 */
function resolve(iterable $items): array
{
    $output = [];
    foreach ($items as $key => $value) {
        $output[$key] = $value;
    }
    return $output;
}

/**
 * Limit items by a predicate applied to value.
 *
 * Example predicate:
 *
 *     function ($value): bool {
 *         return $value > 1;
 *     }
 */
function take(iterable $items, callable $accept): iterable
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
 */
function takeKey(iterable $items, callable $accept): iterable
{
    foreach ($items as $key => $item) {
        if ($accept($key)) {
            yield $key => $item;
        }
    }
}

/**
 * Limit items by a list of keys.
 */
function takeKeys(iterable $items, array $keys): iterable
{
    return takeKey($items, function ($key) use ($keys): bool {
        return in_array($key, $keys, true);
    });
}

/**
 * Resolve a map into a list.
 */
function values(iterable $items): iterable
{
    foreach ($items as $value) {
        yield $value;
    }
}
