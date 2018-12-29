<?php declare(strict_types=1);

namespace Dryist;

/**
 * Create a modifier that constructs an object.
 *
 * @return callable (...) => new class(...)
 */
function make(string $class): callable
{
    return function (...$params) use ($class): object {
        return new $class(...$params);
    };
}
const make = '\Dryist\make';

/**
 * Get the string representation of a value, without modifing nulls.
 *
 * @param mixed $value
 */
function stringify($value): ?string
{
    if ($value === null) {
        return null;
    }

    return (string) $value;
}
const stringify = '\Dryist\stringify';
