# Dryist Functions

[![Build Status](https://travis-ci.com/dryist/functions.svg?branch=master)](https://travis-ci.com/dryist/functions)
[![Code Quality](https://scrutinizer-ci.com/g/dryist/functions/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dryist/functions/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/dryist/functions/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/dryist/functions/?branch=master)
[![Latest Stable Version](http://img.shields.io/packagist/v/dryist/functions.svg?style=flat)](https://packagist.org/packages/dryist/functions)
[![Total Downloads](https://img.shields.io/packagist/dt/dryist/functions.svg?style=flat)](https://packagist.org/packages/dryist/functions)
[![License](https://img.shields.io/packagist/l/dryist/functions.svg?style=flat)](https://packagist.org/packages/dryist/functions)

A variety of utility functions for common programming needs.

## Installation

The best way to install and use this package is with [composer](http://getcomposer.org/):

```shell
composer require dryist/functions
```

## Usage

There are several categories of functions:

- [algebra](#algebra) - some common functional language utilities
- [array](#array) - helpers to work with arrays and iterators
- [tool](#tool) - other various tools

There are a number of other packages that provide compatible (and/or similar)
utility functions, including:

- <https://github.com/ihor/Nspl>
- <https://github.com/krakphp/fn>
- <https://github.com/lstrojny/functional-php>

Any functionality missing in this package can probably be found elsewhere.

### Alegbra

#### always()

Creates a "K combinator" that always returns the original value:

```php
use function Dryist\always;

$fn = always(true);

assert($fn() === true);
```

#### compose()

Creates a "substitution combinator" that composes two callables:

```php
use function Dryist\compose;

$fn = compose('ucwords', 'strtolower');

assert($fn('SALLY SMITH') === 'Sally Smith');
```

#### identity()

Always returns the first input:

```php
use function Dryist\identity;

assert(identity('foo') === 'foo');
```

*This function is also aliased as `Dryist\id`.*

### Array

All of the array functions accept [`iterable`][iterable] variables, including
arrays, iterators, and generators.

[iterable]: https://php.net/manual/language.types.iterable.php

#### count()

Count the number of items in a list or map:

```php
use function Dryist\count;

$items = [1, 2, 3];

assert(count($items) === 3);
```

#### combine()

Combines two lists to create a map:

```php
use function Dryist\combine;
use function Dryist\resolve;

$keys = ['city', 'country'];
$values = ['London', 'England'];
$map = combine($keys, $values);

assert(resolve($map) === ['city' => 'London', 'country' => 'England']);
```

#### keys()

Read the keys from a map into a list:

```php
use function Dryist\keys;
use function Dryist\resolve;

$map = ['name' => 'Jane', 'friends' => 42];
$keys = keys($map);

assert(resolve($keys) === ['name', 'friends']);
```

#### map()

Apply a value modifier to a list or map:

```php
use function Dryist\map;
use function Dryist\resolve;

$list = ['foo', 'bar', 'baz'];
$list = map($list, 'strtoupper');

assert(resolve($list) === ['FOO', 'BAR', 'BAZ']);
```

#### mapBoth()

Apply a value modifier to a list or map:

```php
use function Dryist\mapBoth;
use function Dryist\resolve;

$list = ['foo', 'bar', 'baz'];
$list = mapBoth($list, function ($key, $value) {
    if ($key % 2 === 0) {
        return strtoupper($value);
    }
    return $value;
});

assert(resolve($list) === ['FOO', 'bar', 'BAZ']);
```

*This differs from map() in that the modifier receives both the key and the value.*

#### mapKey()

Apply a key modifier to a list or map:

```php
use function Dryist\mapKey;
use function Dryist\resolve;

$map = ['NAME' => 'Bob', 'GAME' => 'football'];
$map = mapKey($map, 'strtolower');

assert(resolve($map) === ['name' => 'Bob', 'game' => 'football'])
```

#### resolve()

An alias for [`iterator_to_array`](https://php.net/iterator_to_array).

#### take()

Filter a list or map by a predicate of the value:

```php
use function Dryist\take;
use function Dryist\resolve;

$positive = function (int $value): bool {
    return $value > 0;
};

$list = [-100, 0, 100];
$list = take($list, $positive);

// Drop keys
$list = values($list);

assert(resolve($list) === [100]);
```

#### takeKey()

Filter a list or map by a predicate of the key:

```php
use function Dryist\takeKey;
use function Dryist\resolve;

$even = function (int $value): bool {
    return $value % 2 === 0;
};

$map = [13 => 'a', 16 => 'b', 22 => 'c'];
$map = takeKey($map, $even);

// Drop keys
$list = values($map);

assert(resolve($list) === ['b', 'c']);
```

#### takeKeys()

Filter a map by a list of allowed keys:

```php
use function Dryist\takeKeys;
use function Dryist\resolve;

$map = ['name' => 'Cassie', 'friends' => 152, 'age' => 39];
$map = takeKeys($map, ['name']);

assert(resolve($map) === ['name' => 'Cassie']);
```

#### values()

Read the values of a map into a list:

```php
use function Dryist\values;
use function Dryist\resolve;

$map = ['a' => 1, 'b' => 2, 'c' => 3];
$list = values($map);

assert(resolve($list) === [1, 2, 3]);
```

### Tool

#### make()

Create a modifier that constructs an object.

```php
use function Dryist\make;
use function Dryist\map;
use function Dryist\resolve;

$list = [[1, 2, 3], [4, 5], [6]];
$list = map($list, make(ArrayIterator::class));

assert(resolve($list)[0] instanceof ArrayIterator);
```

#### stringify()

Convert a value to a string, unless it is null.

```php
use function Dryist\stringify;

assert(stringify(null) === null);
assert(stringify(42) === "42");
```
