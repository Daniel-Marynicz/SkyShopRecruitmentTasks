<?php

declare(strict_types=1);

namespace App\Tests\Tasks\Task09;

use App\Tasks\Task09\Task09;
use PHPUnit\Framework\TestCase;

class Task09Test extends TestCase
{
    /**
     * @param array<mixed> $array
     *
     * @dataProvider arrayToObjectProvider
     */
    public function testArrayToObject(array $array, object $expectedValue) : void
    {
        $actual = Task09::arrayToObject($array);
        $this->assertEquals($expectedValue, $actual);
    }

    /**
     * @return array<mixed>
     */
    public function arrayToObjectProvider() : array
    {
        return [
            [
                [
                    'Komputery' => [
                        'Laptopy' => [
                            'Akcesoria' => [
                                'Torby' => [],
                            ],
                            'Myszki' => [],
                        ],
                        'Stacjonarne' => [
                            'Dell' => [],
                        ],
                    ],
                    'Monitory' => [
                        'LCD' => [
                            '15' => [],
                        ],
                    ],
                    'Pozostale' => [],
                ],
                // phpcs:ignore
                (object) [
                    'Komputery' => [
                        'Laptopy' =>  [
                            'Akcesoria' =>  [
                                'Torby' =>   [],
                            ],
                            'Myszki' =>   [],
                        ],
                        'Stacjonarne' =>   [
                            'Dell' =>  [],
                        ],
                    ],
                    'Monitory' =>  [
                        'LCD' =>  [
                            '15' => [],
                        ],
                    ],
                    'Pozostale' => [],
                ],
            ],
        ];
    }
}
