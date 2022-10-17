# Ultimate Support

<!-- [![EgoistDeveloper Laravel Support](https://preview.dragon-code.pro/EgoistDeveloper/Ultimate-Support.svg?brand=laravel)](https://github.com/laravel-ready/ultimate-support) -->

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]


Support collection for Laravel. This package is standalone and does not require external packages.

## Install

Install via Composer:

```bash
composer require mhassan654/license-support
```

# Support Classes

## IpSupport

Contains methods for working with IP addresses.

`use Mhassan654\LicenseSupport\Support\IpSupport;`

| Method | Description | Result |
| ------ | ----------- | ------ |
| **isLocalhost** | Check client is from localhost | `boolean` |
| **getLocalhostPublicIp** | Get client public IP address if it is localhost | `null` or `string` |
| **getIP** | Get client real IP address | `string` |

- The `getLocalhostPublicIp` method is useful for checking if the client is from localhost. Uses https://api.ipify.org/?format=json endpoint.
- In laravel native way you can use `Request::ip()` method but this method is cover all cases. For example cloudflare, nginx, etc. Also see this stackoverflow [question](https://stackoverflow.com/q/13646690/6940144).


[badge_downloads]:      https://img.shields.io/packagist/dt/mhassan654/license-support.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/mhassan654/license-support.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/mhassan654/license-support?label=stable&style=flat-square

[badge_unstable]:       https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/mhassan654/license-support
