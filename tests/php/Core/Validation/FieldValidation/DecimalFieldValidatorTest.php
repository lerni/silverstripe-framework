<?php

namespace SilverStripe\Core\Tests\Validation\FieldValidation;

use SilverStripe\Dev\SapphireTest;
use PHPUnit\Framework\Attributes\DataProvider;
use SilverStripe\Core\Validation\FieldValidation\DecimalFieldValidator;

class DecimalFieldValidatorTest extends SapphireTest
{
    public static function provideValidate(): array
    {
        return [
            'valid' => [
                'value' => 123.45,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => true,
            ],
            'valid-negative' => [
                'value' => -123.45,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => true,
            ],
            'valid-zero' => [
                'value' => 0,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => true,
            ],
            'valid-rounded-dp' => [
                'value' => 123.456,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => true,
            ],
            'valid-rounded-up' => [
                'value' => 123.999,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => true,
            ],
            'valid-int' => [
                'value' => 123,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => true,
            ],
            'valid-negative-int' => [
                'value' => -123,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => true,
            ],
            'valid-max' => [
                'value' => 999.99,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => true,
            ],
            'valid-max-negative' => [
                'value' => -999.99,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => true,
            ],
            'valid-null' => [
                'value' => null,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => true,
            ],
            'valid-in-range' => [
                'value' => 5.0,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => 1.0,
                'maxValue' => 10.0,
                'expected' => true,
            ],
            'invalid-below-min' => [
                'value' => 0.5,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => 1.0,
                'maxValue' => 10.0,
                'expected' => false,
            ],
            'invalid-above-max' => [
                'value' => 15.0,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => 1.0,
                'maxValue' => 10.0,
                'expected' => false,
            ],
            'invalid-rounded-to-6-digts' => [
                'value' => 999.999,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => false,
            ],
            'invalid-too-long' => [
                'value' => 1234.56,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => false,
            ],
            'invalid-too-long-3dp' => [
                'value' => 123.456,
                'wholeSize' => 5,
                'decimalSize' => 3,
                'minValue' => null,
                'maxValue' => null,
                'expected' => false,
            ],
            'invalid-too-long-1dp' => [
                'value' => 123.4,
                'wholeSize' => 5,
                'decimalSize' => 3,
                'minValue' => null,
                'maxValue' => null,
                'expected' => false,
            ],
            'invalid-too-long-int' => [
                'value' => 123,
                'wholeSize' => 5,
                'decimalSize' => 3,
                'minValue' => null,
                'maxValue' => null,
                'expected' => false,
            ],
            'invalid-string' => [
                'value' => '123.45',
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => false,
            ],
            'invalid-true' => [
                'value' => true,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => false,
            ],
            'invalid-false' => [
                'value' => false,
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => false,
            ],
            'invalid-array' => [
                'value' => [123.45],
                'wholeSize' => 5,
                'decimalSize' => 2,
                'minValue' => null,
                'maxValue' => null,
                'expected' => false,
            ],
        ];
    }

    #[DataProvider('provideValidate')]
    public function testValidate(
        mixed $value,
        int $wholeSize,
        int $decimalSize,
        ?float $minValue,
        ?float $maxValue,
        bool $expected,
    ): void {
        $validator = new DecimalFieldValidator('MyField', $value, $wholeSize, $decimalSize, $minValue, $maxValue);
        $result = $validator->validate();
        $this->assertSame($expected, $result->isValid());
    }
}
