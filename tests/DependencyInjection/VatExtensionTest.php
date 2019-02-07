<?php

namespace Ibericode\VatBundle\Tests\DependencyInjection;

use DvK\Vat\Countries;
use DvK\Vat\Rates\Rates;
use DvK\Vat\Validator;
use Ibericode\VatBundle\DependencyInjection\VatExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use PHPUnit\Framework\TestCase;

class VatExtensionTest extends TestCase
{
    public function testDefault()
    {
        $container = new ContainerBuilder();
        $loader = new VatExtension();
        $loader->load([[]], $container);
        $this->assertTrue($container->hasDefinition('ibericode_vat.countries'));
        $this->assertTrue($container->hasDefinition('ibericode_vat.rates'));
        $this->assertTrue($container->hasDefinition('ibericode_vat.validator'));

        $this->assertTrue($container->has(Countries::class), 'Countries class is wired');
        $this->assertTrue($container->has(Rates::class), 'Rates class is wired');
        $this->assertTrue($container->has(Validator::class), 'Validator class is wired');
    }
}