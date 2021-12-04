<?php

namespace CrasyHorse\Tests\Feature;

use CrasyHorse\Tests\TestCase;
use CrasyHorse\Testing\Laravel\Fixture;

class FixtureTest extends TestCase
{
    /**
     * @test
     */
    public function successfuly_loads_configuration_object_from_config_file()
    {
        $fixture = new Fixture();
        $actual = $fixture->config();

        $expected =  [
            'default_source' => 'default',
            'sources' => [
                'default' => [
                    'driver' => 'local',
                    'rootpath' => '/home/fweidinger/workspace/phpunitFixtureLaravel/vendor/orchestra/testbench-core/laravel/tests/filesystem/data',
                    'default_file_extension' => 'json'
              ],
                'alternative' => [
                    'driver' => 'local',
                    'rootpath' => '/home/fweidinger/workspace/phpunitFixtureLaravel/vendor/orchestra/testbench-core/laravel/test/filesystem/alternative',
                    'default_file_extension' => 'json'
                ]
            ]
        ];

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function successfuly_merges_custom_configuration_object_with_configuration_from_file()
    {
        $customConfiguration = [
            'sources' => [
                'additional' => [
                    'driver' => 'local',
                    'rootpath' => implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'filesystem', 'additional']),
                    'default_file_extension' => 'json',
                ],
            ],
        ];

        $fixture = new Fixture($customConfiguration);
        $actual = $fixture->config();

        $expected =  [
            'default_source' => 'default',
            'sources' => [
                'default' => [
                    'driver' => 'local',
                    'rootpath' => '/home/fweidinger/workspace/phpunitFixtureLaravel/vendor/orchestra/testbench-core/laravel/tests/filesystem/data',
                    'default_file_extension' => 'json'
                ],
                'alternative' => [
                    'driver' => 'local',
                    'rootpath' => '/home/fweidinger/workspace/phpunitFixtureLaravel/vendor/orchestra/testbench-core/laravel/test/filesystem/alternative',
                    'default_file_extension' => 'json'
                ],
                'additional' => [
                    'driver' => 'local',
                    'rootpath' => '/home/fweidinger/workspace/phpunitFixtureLaravel/tests/Feature/../filesystem/additional',
                    'default_file_extension' => 'json'
                  ]
            ]
        ];

        $this->assertEquals($expected, $actual);
    }
}
