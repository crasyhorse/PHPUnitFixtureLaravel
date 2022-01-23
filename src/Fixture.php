<?php

namespace CrasyHorse\Testing\Laravel;

use CrasyHorse\Testing\Fixture as TestingFixture;

/**
 * Yields an adapter to implement crasyhorse/phpunit-fixture into Laravel.
 *
 * @author Florian Weidinger
 * @since 0.1.0
 */
class Fixture extends TestingFixture
{
    public function __construct(array $configuration = [])
    {
        parent::__construct($this->mergeConfiguration($configuration));
    }

    /**
     * Merges the configuration object from config/fixture.php with a
     * custom config object.
     *
     * @param array $configuration The custom configuration object to merge with config/fixture.php
     *
     * @return array
     */
    public function mergeConfiguration(array $configuration): array
    {
        return array_merge_recursive((array)config('fixture', []), $configuration);
    }
}
