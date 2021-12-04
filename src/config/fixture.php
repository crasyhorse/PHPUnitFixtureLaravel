<?php

return [

    /*
    |-------------------------------------------------------------------------|
    | Sources                                                                 |
    |-------------------------------------------------------------------------|
    |                                                                         |
    | The default source directory used if no other is specified by the user. |
    |                                                                         |
    */
    'default_source' => env('DEFAULT_FIXTURE_SOURCE', 'default'),

    /*
    |-------------------------------------------------------------------------|
    | Sources                                                                 |
    |-------------------------------------------------------------------------|
    |                                                                         |
    | Here you may declare the source directories where your fixture files    |
    | are. You may configure as many sources as you need.                     |
    |                                                                         |
    */
    'sources' => [
        'default' => [
            'driver' => 'local',
            'rootpath' => base_path('tests/filesystem/data'),
            'default_file_extension' => 'json',
        ],
        'alternative' => [
            'driver' => 'local',
            'rootpath' => base_path('test/filesystem/alternative'),
            'default_file_extension' => 'json',
        ],
    ],
];
