<?php declare(strict_types=1);

namespace Dryist;

/**
 * Create a modifier that constructs an object.
 *
 * @param string $class
 *
 * @return callable (...) => new class(...)
 */
function make(string $class): callable
{
    return function (...$params) use ($class): object {
        return new $class(...$params);
    };
}

/**
 * Get the string representation of a value, without modifing nulls.
 *
 * @param mixed $value
 *
 * @return string|null
 */
function stringify($value): ?string
{
    if ($value === null) {
        return null;
    }

    return (string) $value;
}
