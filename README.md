
# Add support for the `USING` directive in join constraints for Laravel query builder

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nihilsen/laravel-join-using.svg?style=flat-square)](https://packagist.org/packages/nihilsen/laravel-join-using)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/nihilsen/laravel-join-using/run-tests?label=tests)](https://github.com/nihilsen/laravel-join-using/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/nihilsen/laravel-join-using/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/nihilsen/laravel-join-using/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/nihilsen/laravel-join-using.svg?style=flat-square)](https://packagist.org/packages/nihilsen/laravel-join-using)

This package adds support for the `USING` SQL directive in join constraints for Laravel query builder.

The `USING` directive is an alternative to the `ON` directive in SQL join constraints. It has been part of the SQL standard since [SQL-92](http://www.java2s.com/Tutorial/Oracle/0140__Table-Joins/SimplifyingJoinswiththeUSINGKeyword.htm).

While `ON` is generally more versatile, there are cases where the `USING` directive is more useful. For example, when doing [equi-joins](https://en.wikipedia.org/wiki/Join_(SQL)#Equi-join), it allows you to specify just the columns on which the join should be constrained. Any columns mentioned in the `USING` list will appear only once in the result set, with an unqualified name, rather than once for each table in the join.

In Laravel, this allows you to add a join to an existing query without having to change the column names in any existing `WHERE` conditions. This is not possible using the `ON` directive if the tables are joined with columns that share the same name, as any unqualified references to the joining columns will result in errors like `Column 'xyz' in where clause is ambiguous`.

The `USING` directive is supported for the following database drivers: `mysql`, `pgsql` and `sqlite`.

Compilation of `USING` is *not* supported for `sqlsrv`, since the `USING` directive is not supported by *MS SQL Server*.

`USING` can be used for all join types supported by your database driver, e.g. `inner join`, `left join`, etc.

## Installation

You can install the package via composer:

```bash
composer require nihilsen/laravel-join-using
```

## Usage

```php
use Illuminate\Support\Facades\DB;
use Nihilsen\LaravelJoinUsing\JoinUsingClause;

DB::table('users')
    ->rightJoin(
        'clients',
        fn (JoinUsingClause $join) => $join->using('email')
    )
    ->whereEmail('foo@bar.com');
// select * from `users` right join `clients` using (`email`) where `email` = ?
```

### Multiple columns in `USING` constraint
```php
use Illuminate\Support\Facades\DB;
use Nihilsen\LaravelJoinUsing\JoinUsingClause;

DB::table('users')->leftJoin(
    'clients',
    fn (JoinUsingClause $join) => $join->using('email', 'name')
);
// select * from `users` left join `clients` using (`email`, `name`)
```

## Credits

- [nihilsen](https://github.com/nihilsen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
