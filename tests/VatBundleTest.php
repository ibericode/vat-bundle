<?php

namespace Ibericode\VatBundle\Tests\DependencyInjection;

use Ibericode\VatBundle\DependencyInjection\VatExtension;
use Ibericode\VatBundle\VatBundle;
use PHPUnit\Framework\TestCase;

class VatBundleTest extends TestCase
{
    public function testGetExtension()
    {
        $bundle = new VatBundle();
        $this->assertInstanceOf(VatExtension::class, $bundle->getContainerExtension());
    }
}