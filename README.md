# Stamps

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require sevenlab/stamps
```

## Usage
Add the labStamps to your migrations and use the trait on the model.
```php
Schema::create('table', function (Blueprint $table) {
    $table->labStamps();
});
```

```php
use LabStamps;
```

LabStamps uses SoftDeletes by default.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [7Lab][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sevenlab/stamps.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sevenlab/stamps.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/sevenlab/stamps/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/sevenlab/stamps
[link-downloads]: https://packagist.org/packages/sevenlab/stamps
[link-travis]: https://travis-ci.org/sevenlab/stamps
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/sevenlab
[link-contributors]: ../../contributors
