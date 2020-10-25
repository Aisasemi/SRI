# SRI

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

A small addon to add sri to your laravel application in a simple way.

## Installation

Via Composer

``` bash
$ composer require aisasemi/sri
```

## Usage

There are 2 methods that we can use.

- get
  - php
    ```
    $integrity = $sri->get('path/to/asset');
    ```
  - blade
    ```
    @sri('path/to/asset');
    ```
- html
  - php
    ```
    $htmltag = $sri->html('path/to/asset');
    $htmltag = $sri->html('path/to/asset', 'anonymous');
    ```
  - blade
    ```
    @srihtml('path/to/asset');
    @srihtml('path/to/asset', 'anonymous');
    ```


## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [author name][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/aisasemi/sri.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/aisasemi/sri.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/aisasemi/sri/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/aisasemi/sri
[link-downloads]: https://packagist.org/packages/aisasemi/sri
[link-travis]: https://travis-ci.org/aisasemi/sri
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/aisasemi
[link-contributors]: ../../contributors
