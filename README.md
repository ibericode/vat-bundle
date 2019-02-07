VAT Bundle
==========

[![Build Status](https://img.shields.io/travis/ibericode/vat-bundle.svg)](https://travis-ci.org/ibericode/vat-bundle)
[![Latest Stable Version](https://img.shields.io/packagist/v/ibericode/vat-bundle.svg)](https://packagist.org/packages/ibericode/vat-bundle)
![PHP from Packagist](https://img.shields.io/packagist/php-v/ibericode/vat-bundle.svg)
![Total Downloads](https://img.shields.io/packagist/dt/ibericode/vat-bundle.svg)
![License](https://img.shields.io/github/license/ibericode/vat-bundle.svg)

This bundle allows you to use [vat.php](https://github.com/ibericode/vat-bundle) in your Symfony4 projects.

vat.php is a simple PHP library which helps you to deal with European VAT rules. It helps you...

- Fetch (historical) VAT rates for any European member state
- Validate VAT numbers (by format, existence or both)
- Validate ISO-3316 alpha-2 country codes
- Determine whether a country is part of the EU
- Geo-locate IP addresses


The library uses jsonvat.com to obtain its data for the VAT rates. Full details can be seen [here](https://github.com/adamcooke/vat-rates).
For VAT number validation, it uses [VIES VAT number validation](http://ec.europa.eu/taxation_customs/vies/).

## Installation

First, install the bundle using Composer.

```
composer require ibericode/vat-bundle
```

Then, load the bundle by adding it to your `config/bundles.php` file.

```php
Ibericode\VatBundle\VatBundle::class => ['all' => true]
```

## Usage

Check out [vat.php](https://github.com/ibericode/vat-bundle) for direct usage examples. This bundle adds service configuration & a validation constraints for VAT numbers.

### Dependency injection

With this bundle enabled, you can use dependency injection to retrieve a class instance for the `Countries`, `Validator` or `Rates` classes.

```php
use DvK\Vat\Countries;
use DvK\Vat\Validator;

class MyController {
    public function __construct(Countries $countries, Validator $validator)
    {
        
    }
}
```

### Validation

To validate a VAT number using Symfony's [Validation](https://symfony.com/doc/current/validation.html) component, you can use the `VatNumber` constraint.

```php
use Ibericode\VatBundle\Validator\Constraints\VatNumber;

class Customer 
{
    /**
    * @VatNumber() 
    */
    public $vatNumber;
}
```

## License

MIT 