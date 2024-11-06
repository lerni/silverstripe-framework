<?php

namespace SilverStripe\Dev\Tests\CsvBulkLoaderTest;

use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;

class Biscuit extends DataObject implements TestOnly
{
    private static $db = [
        'Title' => 'Varchar(255)',
        'MyInt' => 'Int',
        'MyFloat' => 'Float',
        'MyDecimal' => 'Decimal',
    ];

    private static $table_name = 'CsvBulkLoaderTest_Biscuit';
}
