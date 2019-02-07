<?php
namespace Ibericode\VatBundle;

use Ibericode\VatBundle\DependencyInjection\VatExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class VatBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new VatExtension();
    }
}