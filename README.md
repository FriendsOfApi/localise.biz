# Localise.biz (Logo) API client

[![Latest Version](https://img.shields.io/github/release/api-php/localise.biz.svg?style=flat-square)](https://github.com/api-php/localise.biz/releases)
[![Build Status](https://img.shields.io/travis/api-php/localise.biz.svg?style=flat-square)](https://travis-ci.org/api-php/localise.biz)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/api-php/localise.biz.svg?style=flat-square)](https://scrutinizer-ci.com/g/api-php/localise.biz)
[![Quality Score](https://img.shields.io/scrutinizer/g/api-php/localise.biz.svg?style=flat-square)](https://scrutinizer-ci.com/g/api-php/localise.biz)
[![Total Downloads](https://img.shields.io/packagist/dt/api-php/localise.biz.svg?style=flat-square)](https://packagist.org/packages/api-php/localise.biz)


A community client for [Loco](https://localise.biz) (Localise.biz). The official plugin is found [here](https://github.com/loco/loco-php-sdk).

## Install

Via Composer

``` bash
$ composer require api-php/localise.biz
```

## Usage

```php
$apiClient = new LocoClient();
$response = $apiClient->translations()->show('project_key', 'hello_world', 'sv');
echo $response->getTranslation(); // "Hej världen"
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
