<?php


// config/services.php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Ibericode\Vat\Countries;
use Ibericode\Vat\Validator;
use Ibericode\Vat\Rates;
use Ibericode\Vat\Geolocator;
use Ibericode\Vat\Bundle\Validator\Constraints\VatNumberValidator;

return function (ContainerConfigurator $container): void {
    $parameters = $container->parameters();
    $parameters->set('ibericode_vat.rates.storage_path', '%kernel.project_dir%/var/vat-rates');
    $parameters->set('ibericode_vat.rates.ttl', 86400);
    $parameters->set('ibericode_vat.geolocator.service', 'ip2c.org');

    $services = $container->services();
    $services->set('ibericode_vat.countries', Countries::class);
    $services->set('ibericode_vat.validator', Validator::class);
    $services->set('ibericode_vat.rates', Rates::class)
        ->args([
            '$storagePath' => '%ibericode_vat.rates.storage_path%',
            '$refreshInterval' => '%ibericode_vat.rates.ttl%',
        ]);
    $services->set('ibericode_vat.geolocator', Geolocator::class)
        ->args([
            '$service' => '%ibericode_vat.geolocator.service%',
        ]);
    $services->set('ibericode_vat.validator.vat_number_validator', VatNumberValidator::class)
        ->args([
            '$validator' => service('ibericode_vat.validator')
        ]);


    $services->alias(Countries::class, 'ibericode_vat.countries');
    $services->alias(Rates::class, 'ibericode_vat.rates');
    $services->alias(Geolocator::class, 'ibericode_vat.geolocator');
    $services->alias(Validator::class, 'ibericode_vat.validator');
    $services->alias(VatNumberValidator::class, 'ibericode_vat.validator.vat_number_validator');
};
