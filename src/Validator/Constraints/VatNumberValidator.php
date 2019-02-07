<?php

namespace Dvk\VatBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

use DvK\Vat\Validator;
use DvK\Vat\Vies\ViesException;

class VatNumberValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof VatNumber) {
            throw new UnexpectedTypeException($constraint, VatNumber::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        // let DvK\Vat\Validator take care of validating the VAT number value
        $validator = new Validator();
        try {
            $valid = $validator->validate($value);
        } catch (ViesException $e) {
            // ignore VIES VAT exceptions (when the service is down)
            // this could mean that an invalid VAT number enters our database, but it's better than a hard-error
            $valid = true;
        }

        if (false === $valid) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
