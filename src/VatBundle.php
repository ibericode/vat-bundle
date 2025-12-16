<?php
namespace Ibericode\Vat\Bundle;

use Ibericode\Vat\Bundle\DependencyInjection\VatExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class VatBundle extends \Symfony\Component\HttpKernel\Bundle\Bundle
{
    public function getContainerExtension() : ?ExtensionInterface
    {
        return new VatExtension();
    }
}
