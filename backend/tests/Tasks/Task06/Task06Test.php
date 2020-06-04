<?php

declare(strict_types=1);

namespace App\Tests\Tasks\Task06;

use App\Tasks\Task06\Task06;
use PHPUnit\Framework\TestCase;

class Task06Test extends TestCase
{
    /**
     * @param array<mixed> $flatTree
     * @param array<mixed> $expectedTree
     *
     * @dataProvider generateTreeProvider
     */
    public function testGenerateTree(array $flatTree, string $delimiter, array $expectedTree) : void
    {
        $actual = Task06::generateTree($flatTree, $delimiter);
        $this->assertEquals($expectedTree, $actual);
    }

    /**
     * @return array<mixed>
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function generateTreeProvider() : array
    {
        return [
            [
                [
                    'Komputery > Laptopy > Akcesoria > Torby',
                    'Komputery > Laptopy > Myszki',
                    'Monitory > LCD > 15',
                    'Komputery > Stacjonarne > Dell',
                    'Pozostale',
                ],
                '>',
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
            ],
            [
                [
                    'Komputery ) Laptopy ) Akcesoria   )   Torby',
                    'Komputery )         Laptopy         )          Myszki      ',
                    'Monitory ) LCD ) 15',
                    'Komputery ) Stacjonarne ) Dell',
                    'Pozostale',
                ],
                ')',
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
            ],
        ];
    }
}
