# Localise.biz (Loco) API client

[![Latest Version](https://img.shields.io/github/release/FriendsOfApi/localise.biz.svg?style=flat-square)](https://github.com/FriendsOfApi/localise.biz/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/friendsofapi/localise.biz.svg?style=flat-square)](https://packagist.org/packages/FriendsOfApi/localise.biz)

A community client for [Loco](https://localise.biz) (Localise.biz). The official api client is found [here](https://github.com/loco/loco-php-sdk).

## Install

Via Composer

``` bash
$ composer require friendsofapi/localise.biz
```

## Usage

```php
$apiClient = new LocoClient();
$response = $apiClient->translations()->show('project_key', 'hello_world', 'sv');
echo $response->getTranslation(); // "Hej världen"
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
