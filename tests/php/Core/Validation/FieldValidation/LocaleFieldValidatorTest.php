<?php

namespace SilverStripe\Core\Tests\Validation\FieldValidation;

use SilverStripe\Dev\SapphireTest;
use PHPUnit\Framework\Attributes\DataProvider;
use SilverStripe\Core\Validation\FieldValidation\LocaleFieldValidator;

class LocaleFieldValidatorTest extends SapphireTest
{
    public static function provideValidate(): array
    {
        // Using symfony/validator for implementation so only smoke testing
        return [
            'valid' => [
                'value' => 'de_DE',
                'expected' => true,
            ],
            'valid-short' => [
                'value' => 'de',
                'expected' => true,
            ],
            'valid-null' => [
                'value' => null,
                'expected' => true,
            ],
            'invalid-dash' => [
                'value' => 'de-DE',
                'expected' => false,
            ],
            'invalid-not-canonicalize' => [
                'value' => 'DE_de',
                'expected' => false,
            ],
            'invalid' => [
                'value' => 'zz_ZZ',
                'expected' => false,
            ],
            'invalid-short' => [
                'value' => 'zz',
                'expected' => false,
            ],
            'invalid-underscores' => [
                'value' => '_____',
                'expected' => false,
            ],
            'invalid-donut' => [
                'value' => 'donut',
                'expected' => false,
            ],
        ];
    }

    #[DataProvider('provideValidate')]
    public function testValidate(mixed $value, bool $expected): void
    {
        $validator = new LocaleFieldValidator('MyField', $value);
        $result = $validator->validate();
        $this->assertSame($expected, $result->isValid());
    }
}
