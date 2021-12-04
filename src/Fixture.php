<?php

namespace CrasyHorse\Testing\Laravel;

use CrasyHorse\Testing\Fixture as TestingFixture;
use CrasyHorse\Testing\Laravel\Config;

/**
 * Yields an adapter to implement crasyhorse/phpunit-fixture into Laravel.
 *
 * @author Florian Weidinger
 * @since 0.1.0
 */
class Fixture extends TestingFixture
{
    use Config;

    public function __construct(array $config = [])
    {
        parent::__construct($this->mergeConfiguration($config));
    }
}
