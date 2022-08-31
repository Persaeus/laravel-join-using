<?php

namespace Nihilsen\LaravelJoinUsing;

use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\PostgresConnection;
use Illuminate\Database\Query\Grammars\Grammar;
use Illuminate\Database\Query\Grammars\MySqlGrammar;
use Illuminate\Database\Query\Grammars\PostgresGrammar;
use Illuminate\Database\Query\Grammars\SQLiteGrammar;
use Illuminate\Database\SQLiteConnection;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('laravel-join-using');
    }

    public function packageRegistered()
    {
        /**
         * Extend the database connection factory to
         * add support for the USING directive in join
         * clause constraints.
         */
        $this->app->singleton('db.factory', function ($app) {
            return new class ($app) extends ConnectionFactory {
                /**
                 * {@inheritDoc}
                 */
                protected function createConnection($driver, $connection, $database, $prefix = '', array $config = [])
                {
                    if ($resolver = Connection::getResolver($driver)) {
                        return $resolver($connection, $database, $prefix, $config);
                    }

                    $arguments = [$connection, $database, $prefix, $config];

                    return match ($driver) {
                        'mysql' => new class (...$arguments) extends MySqlConnection {
                            use SupportsJoinUsing;

                            public function getQueryGrammarForJoinUsing(): Grammar
                            {
                                return new class () extends MySqlGrammar {
                                    use CompilesJoinUsing;
                                };
                            }
                        },
                        'pgsql' => new class (...$arguments) extends PostgresConnection {
                            use SupportsJoinUsing;

                            public function getQueryGrammarForJoinUsing(): Grammar
                            {
                                return new class () extends PostgresGrammar {
                                    use CompilesJoinUsing;
                                };
                            }
                        },
                        'sqlite' => new class (...$arguments) extends SQLiteConnection {
                            use SupportsJoinUsing;

                            public function getQueryGrammarForJoinUsing(): Grammar
                            {
                                return new class () extends SQLiteGrammar {
                                    use CompilesJoinUsing;
                                };
                            }
                        },
                        default => parent::createConnection(...func_get_args()),
                    };
                }
            };
        });
    }
}
