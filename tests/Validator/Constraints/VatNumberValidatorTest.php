<?php

namespace Ibericode\VatBundle\Tests\Validator\Constraints;

use Ibericode\VatBundle\Validator\Constraints\VatNumber;
use Ibericode\VatBundle\Validator\Constraints\VatNumberValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class VatNumberValidatorTest extends ConstraintValidatorTestCase
{

    protected function createValidator()
    {
        return new VatNumberValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new VatNumber());
        $this->assertNoViolation();
    }

    public function testBlankIsValid()
    {
        $this->validator->validate('', new VatNumber());
        $this->assertNoViolation();
    }

    public function testGoogleIrelandIsValid()
    {
        $this->validator->validate('IE6388047V', new VatNumber());
        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalidValues
     */
    public function testInvalidValues($value)
    {
        $constraint = new VatNumber([
            'message' => 'myMessage',
        ]);
        $this->validator->validate($value, $constraint);
        $this->buildViolation('myMessage')
            ->setParameter('{{ string }}', $value)
            ->assertRaised();
    }

    public function getInvalidValues()
    {
       return [
           ['NL123'],
           ['DE500'],
       ];
    }




}