<?php

namespace Ibericode\Vat\Bundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class VatNumber extends Constraint
{
    public const INVALID_ERROR_CODE = '59421d43-d474-489c-b18c-7701329d51a0';
    public const VIES_EXCEPTION_ERROR_CODE = 'a1be6ee0-f27e-4d51-a132-f0a753c0b01e';

    public string $message = '"{{ string }}" does not look like a valid VAT number.';
    public string $exceptionMessage = 'An error occurred while checking VAT number, please try again later';

    public bool $checkExistence = true;
    public bool $violateOnException = false;
}
