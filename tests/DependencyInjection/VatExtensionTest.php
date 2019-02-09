<?php

namespace Ibericode\Vat\Bundle\Tests\DependencyInjection;

use Ibericode\Vat\Countries;
use Ibericode\Vat\Rates;
use Ibericode\Vat\Validator;
use Ibericode\Vat\Bundle\DependencyInjection\VatExtension;
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