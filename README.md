# Laravel Instagram

[![Latest Version on Packagist](https://img.shields.io/packagist/v/retinens-be/laravel-instagram.svg?style=flat-square)](https://packagist.org/packages/retinens-be/laravel-instagram)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)
[![Build Status](https://travis-ci.org/retinens-be/laravel-instagram.svg?branch=master)](https://travis-ci.org/retinens-be/laravel-instagram)
![Codecov](https://img.shields.io/codecov/c/gh/retinens-be/laravel-instagram?style=flat-square)
[![Total Downloads](https://img.shields.io/packagist/dt/retinens-be/laravel-instagram.svg?style=flat-square)](https://packagist.org/packages/retinens-be/laravel-instagram)


This package adds an Instagram post model to your Laravel application, for a cool feed or something like this.

The package relies on the `vinkla/instagram` package, and adds a solution to cache and a model 

## Installation

You can install the package via composer:

```bash
composer require retinens-be/laravel-instagram
```
Then run the migrations used for caching, as the API is limited to 200 calls/hour.
```bash
php artisan migrate
```

## Usage
First you need to generate an access token using Pixel Union's [access token generator](http://instagram.pixelunion.net) or by creating an [Instagram application](https://www.instagram.com/developer/authentication).

Put this API key in your .env file
```
INSTAGRAM_KEY=YOUR_KEY
```

You can run the command to update the cache.

``` php
php artisan laravel-instagram:refresh
```

NOTE : you have to run the Laravel Scheduler in background to use this package. This package adds a command which is executed every 10 minutes to update the cache. [More info about the Laravel scheduler](https://laravel.com/docs/master/scheduling)

To retrieve all posts use the facade : (this is limited to the latests)
``` php
LaravelInstagram::getPosts()
```
You can specify a number of post to get, it will get the most recents ones : 
``` php
LaravelInstagram::getPosts(4)
```

This returns a collection with all the posts stored. 

On each post, you can get attributes:
``` php
// Full Size Image
$post->standardResolutionImageUrl
// Caption text 
$post->captionText
// HTML formatted caption text (use {!! !!} to escape <br> tags)
$post->htmlCaptionText
// Link to the post
$post->link
```

## Credits

- [Lucas Houssa](https://github.com/whereislucas)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
