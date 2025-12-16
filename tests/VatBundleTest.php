<?php

namespace Ibericode\Vat\Bundle\Tests\DependencyInjection;

use Ibericode\Vat\Bundle\DependencyInjection\VatExtension;
use Ibericode\Vat\Bundle\VatBundle;

use PHPUnit\Framework\TestCase;

class VatBundleTest extends TestCase
{
    public function testGetExtension()
    {
        $bundle = new VatBundle();
        $this->assertInstanceOf(VatExtension::class, $bundle->getContainerExtension());
    }
}
