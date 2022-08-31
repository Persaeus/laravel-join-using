<?php

namespace Nihilsen\LaravelJoinUsing\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Nihilsen\LaravelJoinUsing\ServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
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
