<?php

namespace Ibericode\Vat\Bundle\Tests\Validator\Constraints;

use Ibericode\Vat\Bundle\Validator\Constraints\VatNumber;
use Ibericode\Vat\Bundle\Validator\Constraints\VatNumberValidator;
use Ibericode\Vat\Validator;
use Ibericode\Vat\Vies\ViesException;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class VatNumberExceptionValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ConstraintValidatorInterface
    {
        $mockValidator = $this->createMock(Validator::class);
        $mockValidator
            ->method('validateVatNumber')
            ->willThrowException(new ViesException());

        return new VatNumberValidator($mockValidator);
    }

    public function testViesExceptionValid()
    {
        $constraint = new VatNumber([
            'violateOnException' => false,
        ]);
        $this->validator->validate('IE6388047V', $constraint);
        $this->assertNoViolation();
    }

    public function testViesExceptionError()
    {
        $constraint = new VatNumber([
            'violateOnException' => true,
        ]);
        $this->validator->validate('IE6388047V', $constraint);
        $this->buildViolation('An error occurred while checking VAT number, please try again later')
            ->setCode('a1be6ee0-f27e-4d51-a132-f0a753c0b01e')
            ->assertRaised();
    }
}
