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
