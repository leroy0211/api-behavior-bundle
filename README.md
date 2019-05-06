Api Toolkit Bundle
============

This bundle provides some easy tools to create API's. 

It is loosely based on Spring Framework. 

## Installation

Add dependency:

```sh
composer require baxmusic/api-toolkit-bundle
```

Enable bundle:

Symfony 4

```php
#bundles.php
BaxMusic\Bundle\ApiToolkit\BaxMusicApiToolkitBundle::class => ['all' => true],
```

Symfony 3

```php
$bundles[] = new BaxMusic\Bundle\ApiToolkit\BaxMusicApiToolkitBundle();
```

## Configuration

```yaml
# app/config/config.yml
baxmusic_api_toolkit:
```

## Usage

Describe shortly what the bundle does and how to use it.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
