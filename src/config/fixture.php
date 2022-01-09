<?php

return [

    /*
    |-------------------------------------------------------------------------|
    | Sources                                                                 |
    |-------------------------------------------------------------------------|
    |                                                                         |
    | Here you may declare the source directories where your fixture files    |
    | are. You may configure as many sources as you need.                     |
    |                                                                         |
    */
    'loaders' => [
        'Local' => '\\CrasyHorse\\Testing\\Loader\\LocalLoader'
    ],
    'encoders' => [
        'base64' => '\\CrasyHorse\\Testing\\Encoder\\Base64'
    ],
    'readers' => [
        'application/json' => '\\CrasyHorse\\Testing\\Reader\\JsonReader',
        '*/*' => '\\CrasyHorse\\Testing\\Reader\\BinaryReader'
    ],
    'sources' => [
        'default' => [
            'driver' => 'Local',
            'root_path' => implode(DIRECTORY_SEPARATOR, [base_path(), 'tests', 'data', 'default']),
            'default_file_extension' => 'json',
            'encode' => [
                [
                    'mime-type' => '*/*',
                    'encoder' => 'base64'
                ]
            ]
        ],
    ],
];
