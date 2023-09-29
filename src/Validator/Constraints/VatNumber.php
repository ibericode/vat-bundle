<?php

namespace Ibericode\Vat\Bundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class VatNumber extends Constraint
{
    public const INVALID_ERROR_CODE = '59421d43-d474-489c-b18c-7701329d51a0';

    public string $message = '"{{ string }}" does not look like a valid VAT number.';
}
