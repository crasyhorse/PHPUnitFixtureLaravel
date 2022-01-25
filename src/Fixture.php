<?php

namespace CrasyHorse\Testing\Laravel;

use CrasyHorse\Testing\Fixture as TestingFixture;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Yields an adapter to implement crasyhorse/phpunit-fixture into Laravel.
 *
 * @author Florian Weidinger
 *
 * @since 0.1.0
 */
class Fixture extends TestingFixture
{
    /**
     * Merges the configuration object from "config/fixture.php" with the
     * configuration object given by the user.
     *
     * @param array $configuration The custom configuration object
     *
     * @throws \CrasyHorse\Testing\Exceptions\InvalidConfigurationException
     */
    public function __construct(array $configuration = [])
    {
        parent::__construct($this->mergeConfiguration($configuration));
    }

    /**
     * Merges the configuration object from config/fixture.php with a
     * custom config object.
     */
    public function mergeConfiguration(array $configuration): array
    {
        try {
            $config = array_merge_recursive((array)config('fixture', []), $configuration);
        } catch (BindingResolutionException $e) {
            return $configuration;
        }

        return $config;
    }
}
