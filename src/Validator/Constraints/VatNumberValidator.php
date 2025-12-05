<?php

namespace Ibericode\Vat\Bundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

use Ibericode\Vat\Validator;
use Ibericode\Vat\Vies\ViesException;

class VatNumberValidator extends ConstraintValidator
{
    public function __construct(private Validator $validator = new Validator())
    {
    }

    public function validate(mixed $value, Constraint $constraint) : void
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

        if ($constraint->checkExistence) {
            try {
                $valid = $this->validator->validateVatNumber($value);
            } catch (ViesException $e) {
                if ($constraint->violateOnException) {
                    $this->context->buildViolation($constraint->exceptionMessage)
                        ->setCode(VatNumber::VIES_EXCEPTION_ERROR_CODE)
                        ->addViolation();

                    return;
                }

                // ignore VIES VAT exceptions (when the service is down)
                // this could mean that an unexisting VAT number passes validation,
                // but it's (probably) better than a hard-error
                $valid = true;
            }
        } else {
            $valid = $this->validator->validateVatNumberFormat($value);
        }

        if (false === $valid) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->setCode(VatNumber::INVALID_ERROR_CODE)
                ->addViolation();
        }
    }
}
