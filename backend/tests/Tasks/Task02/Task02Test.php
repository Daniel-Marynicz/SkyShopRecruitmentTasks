<?php

declare(strict_types=1);

namespace App\Tests\Tasks\Task02;

use App\Tasks\Task02\Task02;
use PHPUnit\Framework\TestCase;

class Task02Test extends TestCase
{
    /**
     * @dataProvider sanitizeNumbersProvider
     */
    public function testSanitizeNumbers(string $value, string $expected) : void
    {
        $actual = Task02::sanitizeNumbers($value);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array<mixed>
     */
    public function sanitizeNumbersProvider() : array
    {
        return [
            [
                'sadjanbasbqwe2233asdsabcdkj3242asas das234234fcdscsda32423 sdaASD@#%#FRE234 ',
                '2233324223423432423234',
            ],
            [
                'ala ma kot 3245 232@445',
                '3245232445',
            ],
        ];
    }
}
