VAT Bundle
==========

This bundle allows you to use [vat.php](https://github.com/dannyvankooten/vat.php) in your Symfony4 projects.

vat.php is a simple PHP library which helps you to deal with European VAT rules. It helps you...

- Fetch (historical) VAT rates for any European member state
- Validate VAT numbers (by format, existence or both)
- Validate ISO-3316 alpha-2 country codes
- Determine whether a country is part of the EU
- Geo-locate IP addresses


The library uses jsonvat.com to obtain its data for the VAT rates. Full details can be seen [here](https://github.com/adamcooke/vat-rates).
For VAT number validation, it uses [VIES VAT number validation](http://ec.europa.eu/taxation_customs/vies/).

### Installation

```
composer require dannyvankooten/vat-bundle
```

### Usage

Check out [vat.php](https://github.com/dannyvankooten/vat.php) for direct usage examples. The `Countries` and `Validator` class can be auto-wired.

```php
use DvK\Vat\Countries;
use DvK\Vat\Validator;




```

##### Validation

To validate a VatNumber using Symfony's [Validation](https://symfony.com/doc/current/validation.html) component, you can use the `VatNumber` constraint.

```php
use Dvk\VatBundle\Validator\Constraints\VatNumber;

class Customer 
{
    /**
    * @VatNumber() 
    */
    public $vatNumber;
}
```

### License
MIT