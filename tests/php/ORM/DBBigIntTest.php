<?php

namespace SilverStripe\ORM\Tests;

use SilverStripe\Dev\SapphireTest;
use SilverStripe\ORM\FieldType\DBBigInt;
use PHPUnit\Framework\Attributes\DataProvider;

class DBBigIntTest extends SapphireTest
{
    public static function provideSetValue(): array
    {
        return [
            'int' => [
                'value' => 3,
                'expected' => 3,
            ],
            'string-int' => [
                'value' => '3',
                'expected' => 3,
            ],
            'string-int-max' => [
                'value' => '9223372036854775807',
                // note: need to cast string to int rather than use defined int or it will turn into a float
                'expected' => (int) '9223372036854775807',
            ],
            'string-int-min' => [
                'value' => '-9223372036854775808',
                // note: need to cast string to int rather than use defined int or it will turn into a float
                'expected' => (int) '-9223372036854775808',
            ],
            'string-int-too-large' => [
                'value' => '9223372036854775808',
                'expected' => '9223372036854775808',
            ],
            'string-int-too-small' => [
                'value' => '-9223372036854775809',
                'expected' => '-9223372036854775809',
            ],
        ];
    }

    #[DataProvider('provideSetValue')]
    public function testSetValue(mixed $value, mixed $expected): void
    {
        $field = new DBBigInt('MyField');
        $field->setValue($value);
        $this->assertSame($expected, $field->getValue());
    }
}
