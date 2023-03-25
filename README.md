
# Laravel `JOIN USING` 🖇️

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nihilsen/laravel-join-using.svg?style=flat-square)](https://packagist.org/packages/nihilsen/laravel-join-using)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/nihilsen/laravel-join-using/run-tests?label=tests)](https://github.com/nihilsen/laravel-join-using/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/nihilsen/laravel-join-using/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/nihilsen/laravel-join-using/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/nihilsen/laravel-join-using.svg?style=flat-square)](https://packagist.org/packages/nihilsen/laravel-join-using)

This package adds support for the `USING` directive in join constraints for Laravel query builder.

## Installation

You can install the package via composer:

```bash
composer require nihilsen/laravel-join-using
```

## Usage

```php

use Illuminate\Support\Facades\DB;
use Nihilsen\LaravelJoinUsing\JoinUsingClause;

$query = DB::table('left_table')->rightJoin(
    'right_table',
    fn (JoinUsingClause $join) => $join->using('shared_column')
);

echo $query->toSql() // select * from "left_table" right join "right_table" using ("shared_column")

```

## Credits

- [nihilsen](https://github.com/nihilsen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
