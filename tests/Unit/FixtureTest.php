<?php

namespace CrasyHorse\Tests\Unit;

use CrasyHorse\Tests\TestCase;
use CrasyHorse\Testing\Laravel\Fixture;
use CrasyHorse\Testing\Config\Config;

class FixtureTest extends TestCase
{
    /**
     * @test
     * @group Fixture
     * @testdox fixture method loads $_dataName
     * @runInSeparateProcess
     * @dataProvider fixture_provider
     */
    public function fixture_loads_fixtures($fixtures, $expected, $expectedCounter): void
    {
        $customConfiguration = [
            'sources' => [
                'additional' => [
                    'driver' => 'Local',
                    'root_path' => implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'data', 'additional']),
                    'default_file_extension' => 'json',
                ],
            ],
        ];

        $fixture = new Fixture($customConfiguration);

        $content = $fixture
            ->source('additional')
            ->fixture($fixtures);

        $actual = $content->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertCount($expectedCounter, $actual['data']);
    }


    /**
     * @test
     * @group Fixture
     * @runInSeparateProcess
     */
    public function successfuly_loads_configuration_object_from_config_file()
    {
        $fixture = new Fixture();
        $actual = Config::getInstance()->get();

        $expected = [
            "loaders" => [
                "Local" => "\\CrasyHorse\\Testing\\Loader\\LocalLoader"
            ],
            "encoders" => [
                "base64" => "\\CrasyHorse\\Testing\\Encoder\\Base64"
            ],
            "readers" => [
                "application/json" => "\\CrasyHorse\\Testing\\Reader\\JsonReader",
                "*/*" => "\\CrasyHorse\\Testing\\Reader\\BinaryReader"
            ],
            "sources" => [
                "default" => [
                    "driver" => "Local",
                    "root_path" => "/home/fweidinger/workspace/phpunitFixtureLaravel/vendor/orchestra/testbench-core/laravel/tests/data/default",
                    "default_file_extension" => "json",
                    "encode" => [
                        [
                            "mime-type" => "*/*",
                            "encoder" => "base64"
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @group Fixture
     * @runInSeparateProcess
     */
    public function successfuly_merges_custom_configuration_object_with_configuration_from_file()
    {
        $customConfiguration = [
            'sources' => [
                'additional' => [
                    'driver' => 'Local',
                    'root_path' => implode(DIRECTORY_SEPARATOR, [base_path(), '..', 'filesystem', 'additional']),
                    'default_file_extension' => 'json',
                ],
            ],
        ];

        $fixture = new Fixture($customConfiguration);
        $actual = Config::getInstance()->get();

        $expected = [
            "loaders" => [
                "Local" => "\\CrasyHorse\\Testing\\Loader\\LocalLoader"
            ],
            "encoders" => [
                "base64" => "\\CrasyHorse\\Testing\\Encoder\\Base64"
            ],
            "readers" => [
                "application/json" => "\\CrasyHorse\\Testing\\Reader\\JsonReader",
                "*/*" => "\\CrasyHorse\\Testing\\Reader\\BinaryReader"
            ],
            "sources" => [
                "default" => [
                    "driver" => "Local",
                    "root_path" => "/home/fweidinger/workspace/phpunitFixtureLaravel/vendor/orchestra/testbench-core/laravel/tests/data/default",
                    "default_file_extension" => "json",
                    "encode" => [
                        [
                            "mime-type" => "*/*",
                            "encoder" => "base64"
                        ]
                    ]
                ],
                "additional" => [
                    "driver" => "Local",
                    "root_path" => "/home/fweidinger/workspace/phpunitFixtureLaravel/vendor/orchestra/testbench-core/laravel/../filesystem/additional",
                    "default_file_extension" => "json"
                  ]

            ]
        ];

        $this->assertEquals($expected, $actual);
    }

    public function fixture_provider(): array
    {
        return [
            'a single fixture from a json file.' => [
                'fixture-001.json',
                [
                    'data' => [
                        [
                            'key' => 'FIXTURE-001',
                            'text' => 'This is a sample text!',
                            'status' => 'working',
                            'updated' => '2021-10-27 10:35:45.0',
                        ],
                    ],
                ],
                1
            ],
            'a list of two fixtures from json files.' => [
                ['fixture-001.json', 'fixture-002.json'],
                [
                    'data' => [
                        [
                            'key' => 'FIXTURE-001',
                            'text' => 'This is a sample text!',
                            'status' => 'working',
                            'updated' => '2021-10-27 10:35:45.0',
                        ],
                        [
                            'key' => 'FIXTURE-002',
                            'text' => 'This is another sample text!',
                            'status' => 'stopped',
                            'updated' => '2021-10-27 10:36:27.0',
                        ],
                    ],
                ],
                2
            ]
        ];
    }
}
