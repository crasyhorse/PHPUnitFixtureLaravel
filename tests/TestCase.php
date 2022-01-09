<?php

namespace CrasyHorse\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use CrasyHorse\Testing\Laravel\Providers\PhpUnitFixtureLaravelServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }

    protected function getPackageProviders($app)
    {
        return [
            PhpUnitFixtureLaravelServiceProvider::class,
        ];
    }
}
