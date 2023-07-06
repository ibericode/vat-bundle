VAT Bundle
==========

[![Build Status](https://github.com/ibericode/vat-bundle/actions/workflows/php.yml/badge.svg)](https://github.com/ibericode/vat-bundle/actions/runs/5474441948)
[![Latest Stable Version](https://img.shields.io/packagist/v/ibericode/vat-bundle.svg)](https://packagist.org/packages/ibericode/vat-bundle)
![PHP from Packagist](https://img.shields.io/packagist/php-v/ibericode/vat-bundle.svg)
![Total Downloads](https://img.shields.io/packagist/dt/ibericode/vat-bundle.svg)
![License](https://img.shields.io/github/license/ibericode/vat-bundle.svg)

This bundle allows you to use [ibericode/vat](https://github.com/ibericode/vat) in your [Symfony](https://symfony.com/) projects.

- Fetch VAT rates for any European member state from [ibericode/vat-rates](https://github.com/ibericode/vat-rates)
- Validate VAT numbers (by format and existence)
- Validate ISO-3316 alpha-2 country codes
- Determine whether a country is part of the EU
- Geo-locate IP addresses

The official [VIES VAT number validation](http://ec.europa.eu/taxation_customs/vies/) SOAP API is used for validating VAT numbers.

## Installation

First, install the bundle using Composer.

```
composer require ibericode/vat-bundle
```

Then, load the bundle by adding it to your `config/bundles.php` file.

```php
Ibericode\Vat\Bundle\VatBundle::class => ['all' => true]
```

## Usage

Check out [ibericode/vat](https://github.com/ibericode/vat) for direct usage examples. This bundle adds service configuration & a validation constraint for VAT numbers.

### Dependency injection

With this bundle enabled, you can use dependency injection to retrieve a class instance for the `Countries`, `Validator`, `Rates` or `Geolocator` classes.

```php
use Ibericode\Vat\Countries;
use Ibericode\Vat\Validator;
use Ibericode\Vat\Rates;
use Ibericode\Vat\Geolocator;

class MyController 
{
    /**
     * Type-hint the class on your service constructors to retrieve a class instance
     */
    public function __construct(
        Rates $rates, 
        Validator $validator,
        Countries $countries, 
        Geolocator $geolocator
        )
    {
        $rates->getRateForCountry('NL'); // 21.00
        $validator->validateVatNumber('NL123456789B01'); // false
        $countries->isCountryCodeInEU('US') // false
        $geolocator->locateIpAddress('8.8.8.8'); // US
    }
}
```

### Validation

To validate a VAT number using Symfony's [Validation](https://symfony.com/doc/current/validation.html) component, you can use the `VatNumber` constraint.

```php
use Ibericode\Vat\Bundle\Validator\Constraints\VatNumber;

class Customer 
{
    /**
    * @VatNumber() 
    */
    public $vatNumber;
}
```

## License

MIT licensed. See the [LICENSE](LICENSE) file for details.
