<?php

namespace Nihilsen\LaravelJoinUsing\Tests;

use Nihilsen\LaravelJoinUsing\JoinUsingServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            JoinUsingServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-join-using_table.php.stub';
        $migration->up();
        */
    }
}
