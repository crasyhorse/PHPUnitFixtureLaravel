<?php

namespace CrasyHorse\Testing\Laravel;

use Adbar\Dot;

/**
 * Shadows CrasyHorse\Testing\Config to make the "config" method compatible
 * with Laravel's Configuration facade.
 *
 * @author Florian Weidinger
 * @since 0.1.0
 */
trait Config
{
    /**
     * Wrapper for Laravel's config helper function to return the fixture's
     * configuration.
     *
     * @param string|null $name The name of the configuration object to return
     *
     * @return array
     */

    public function config(string $name = null): array
    {
        $dot = new Dot($this->configuration);

        $configuration = empty($name) ? $this->configuration : $dot->get($name);

        return $configuration ?? [];
    }

    /**
     * Merges the configuration object from config/fixture.php with a
     * custom config object.
     *
     * @param array $config The custom configuration object to merge with config/fixture.php
     *
     * @return array
     */
    protected function mergeConfiguration(array $config = []): array
    {
        $this->configuration = array_merge_recursive(config('fixture', []), $config);

        return $this->configuration;
    }
}
