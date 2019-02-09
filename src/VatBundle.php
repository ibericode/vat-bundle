<?php
namespace Ibericode\Vat\Bundle;

use Ibericode\Vat\Bundle\DependencyInjection\VatExtension; 

class VatBundle extends \Symfony\Component\HttpKernel\Bundle\Bundle
{
    public function getContainerExtension()
    {
        return new VatExtension();
    }
}