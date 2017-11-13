# Specter

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

[Ghost](https://ghost.org) + [Laravel](https://laravel.com) = :heart:

Specter provides the means to interact with a Ghost database inside Laravel.
Whether you want to use Ghost headless or integrate it into an existing app, this is the package for you.

## :warning: Warning :warning:

Please note that this is not an API client; Specter  accesses your Ghost database _directly_. Use with caution.

In addition, this package is a work in progress. Breaking changes may be introduced.

## Install

``` bash
composer require geekish/specter
```

## Usage

This package requires Laravel 5.5+ and is set up for auto-discovery.

If you want to use the default routes files provided by Specter, you may add `Specter\Providers\RouteServiceProvider` to your config/app.php manually.

### Customization

If you want to customize config values:

``` bash
php artisan vendor:publish --provider="Specter\\ServiceProvider"
```

Currently there is only one config item: posts per page. You may also set this value in your env file:

``` env
SPECTER_PER_PAGE=3
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email <hannahwarmbier@gmail.com> instead of using the issue tracker.

## Credits

- [Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/geekish/specter.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/geekish/specter/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/geekish/specter.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/geekish/specter.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/geekish/specter.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/geekish/specter
[link-travis]: https://travis-ci.org/geekish/specter
[link-scrutinizer]: https://scrutinizer-ci.com/g/geekish/specter/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/geekish/specter
[link-downloads]: https://packagist.org/packages/geekish/specter
[link-contributors]: ../../contributors
