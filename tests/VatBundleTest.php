<?php

namespace Ibericode\VatBundle\Tests\DependencyInjection;

use Ibericode\Vat\Rates;
use Ibericode\VatBundle\DependencyInjection\VatExtension;
use Ibericode\VatBundle\VatBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Tests\Simple\Psr6CacheWithoutAdapterTest;

class VatBundleTest extends TestCase
{
    public function testGetExtension()
    {
        $bundle = new VatBundle();
        $this->assertInstanceOf(VatExtension::class, $bundle->getContainerExtension());
    }


}