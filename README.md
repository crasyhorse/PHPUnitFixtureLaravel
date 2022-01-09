PHP-Unit Fixture Laravel[![Release](https://img.shields.io/github/v/release/crasyhorse/PHPUnitFixtureLaravel)](https://github.com/crasyhorse/PHPUnitFixtureLaravel/releases/tag/0.2.0) [![Downloads](https://img.shields.io/github/downloads/crasyhorse/PHPUnitFixtureLaravel/total)](https://github.com/crasyhorse/PHPUnitFixtureLaravel)
=========

This is an adapter for PHP-Unit Fixture to embed it seamlessly into the Laravel framework.

Built with PHP 7.4, PHP-Unit 9.5.7 and XDebug 2.9.8

# Installation
[![Package](https://img.shields.io/badge/Composer%20package-0.2.0-brightgreen)](https://github.com/crasyhorse/PHPUnitFixtureLaravel/releases/tag/0.2.0)

PHP-Unit Fixture Laravel has actualy not been published to [packagist.org](https://packagist.org) because it is still in development.

To install it you need to configure this Github repository in your composer.json.

```json
    "repositories": [
        {
            "type": "vcs",
            "url":  "https://github.com/crasyhorse/PHPUnitFixtureLaravel.git"
        }
    ],
```

Now you may install the package via Composer 2.x.

```
composer require --dev crasyhorse/phpunit-fixture-laravel
```

# Usage
1. Publish the configuration from the package
```bash
php artisan vendor:publish --tag=fixture:config
```
2. Open ```config/fixture.php``` and modify to fit your needs.
3. Use The ```Fixture``` class to load what ever fixtures you want.
```php
/*
 * Initialize the Fixture class and load the configuration from config/fixture.php
 */
$fixture = new Fixture();
$content = $fixture
    ->fixture('fixture-001')
    ->toArray();

/*
 * Initialize the Fixture class and merge $additionalConfiguration with the configuration from config/fixture.php
 */
$additionalConfiguration = [
    'sources' => [
        'additional' => [
            'driver' => 'Local',
            'root_path' => implode(DIRECTORY_SEPARATOR, [base_path(), '..', 'data', 'additional']),
            'default_file_extension' => 'json',
        ],
    ],
];

$fixture = new Fixture($additionalConfiguration);
$content = $fixture
    ->source('additional')
    ->fixture('fixture-001')
    ->toArray();

```
You will find more infos about loading fixture in the [Documentation](https://github.com/crasyhorse/PHPUnitFixture/blob/master/DOCUMENTATION.md) of the PHP-Unit Fixture package.
# License

[![License](https://img.shields.io/github/license/crasyhorse/PHPUnitFixtureLaravel?color=light%20green)](https://github.com/crasyhorse/PHPUnitFixtureLaravel/blob/master/LICENSE.md)

This project is licensed under the terms of the [MIT License](https://github.com/crasyhorse/PHPUnitFixtureLaravel/blob/master/LICENSE.md).