<?php declare(strict_types=1);

namespace Dryist;

/**
 * Create a modifier that always returns the same value.
 *
 * Also known as the Kestrel or "K" combinator.
 *
 * @see https://en.wikipedia.org/wiki/SKI_combinator_calculus
 *
 * @param mixed $x
 * @return callable () => x
 */
function always($x): callable
{
    return function () use ($x) {
        return $x;
    };
}
const always = '\Dryist\always';

/**
 * Create a composition of two modifiers.
 *
 * Also known as the Substition or "S" combinator.
 *
 * @return callable (z) => x(y(z))
 */
function compose(callable $x, callable $y): callable
{
    return function ($z) use ($x, $y) {
        return $x($y($z));
    };
}
const compose = '\Dryist\compose';

/**
 * @alias identity()
 */
function id($x)
{
    return identity($x);
}
const id = '\Dryist\identity';

/**
 * Return any given variable.
 *
 * Also known as the Identity or "I" combinator.
 *
 * @see https://en.wikipedia.org/wiki/SKI_combinator_calculus
 *
 * @param mixed $x
 * @return mixed The value of $x
 */
function identity($x)
{
    return $x;
}
const identity = '\Dryist\identity';

/**
 * Create a negated predicate.
 *
 * @return callable (y) => ! x(y)
 */
function invert(callable $x): callable
{
    return function ($y) use ($x): bool {
        return ! $x($y);
    };
}
const invert = '\Dryist\invert';
