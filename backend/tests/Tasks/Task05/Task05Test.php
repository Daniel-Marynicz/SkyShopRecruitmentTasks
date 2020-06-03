<?php

declare(strict_types=1);

namespace App\Tests\Tasks\Task05;

use App\Tasks\Task05\Amount;
use App\Tasks\Task05\Invoice\Invoice;
use App\Tasks\Task05\Invoice\InvoiceProduct;
use App\Tasks\Task05\Invoice\VatRate;
use App\Tasks\Task05\Price;
use App\Tasks\Task05\Product;
use App\Tasks\Task05\Vat;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;
use function round;

class Task05Test extends TestCase
{
    /**
     * @param array<mixed> $products
     * @param VatRate[]    $expectedSummaryRates
     *
     * @dataProvider invoiceProvider
     */
    public function testInvoice(array $products, array $expectedSummaryRates) : void
    {
        $invoice = new Invoice();
        foreach ($products as $product) {
            $invoice->addInvoiceProduct(
                new InvoiceProduct(
                    $this->createProduct(
                        $product['name'],
                        $product['grossPrice'],
                        new Vat(
                            $product['vat'],
                            $product['vatRepresentation'] ?? null
                        )
                    ),
                    new Amount($product['amount'])
                )
            );
        }

        $actualSummary = $invoice->createSummary();
        $this->assertEquals($expectedSummaryRates, $actualSummary->getVatRates());
    }

    /**
     * @return array<mixed>
     */
    public function invoiceProvider() : array
    {
        return [
            [
                [
                    [
                        'name' => 'Product 1',
                        'grossPrice' => 100.33,
                        'amount' => 5,
                        'vat' => 23,
                    ],
                    [
                        'name' => 'Product 3',
                        'grossPrice' => 99.11,
                        'amount' => 1,
                        'vat' => 23,
                    ],
                    [
                        'name' => 'Product 4',
                        'grossPrice' => 77.17,
                        'amount' => 7,
                        'vat' => 23,
                    ],
                ],
                [
                    $this->createVatRate(23, '23%', 927.61, 213.35, 1140.96),
                    $this->createVatRate(0, 'Total', 927.61, 213.35, 1140.96),
                ],
            ],
            [
                [
                    [
                        'name' => 'Product 1',
                        'grossPrice' => 100.33,
                        'amount' => 5,
                        'vat' => 23,
                    ],
                    [
                        'name' => 'Product 2',
                        'grossPrice' => 3.79,
                        'amount' => 3,
                        'vat' => 8,
                    ],
                    [
                        'name' => 'Product 3',
                        'grossPrice' => 99.11,
                        'amount' => 1,
                        'vat' => 23,
                    ],
                    [
                        'name' => 'Product 4',
                        'grossPrice' => 77.17,
                        'amount' => 7,
                        'vat' => 23,
                    ],
                    [
                        'name' => 'Product 5',
                        'grossPrice' => 14.22,
                        'amount' => 7,
                        'vat' => 8,
                    ],
                    [
                        'name' => 'Product 6',
                        'grossPrice' => 17.99,
                        'amount' => 11,
                        'vat' => 0,
                    ],
                    [
                        'name' => 'Product 7',
                        'grossPrice' => 17.99,
                        'amount' => 11,
                        'vat' => 0,
                        'vatRepresentation' => 'zw',
                    ],
                    [
                        'name' => 'Product 8',
                        'grossPrice' => 20.99,
                        'amount' => 7,
                        'vat' => 0,
                        'vatRepresentation' => 'zw',
                    ],
                ],
                [
                    $this->createVatRate(23, '23%', 927.61, 213.35, 1140.96),
                    $this->createVatRate(8, '8%', 102.72, 8.22, 110.94),
                    $this->createVatRate(0, '0%', 197.89, 0, 197.89),
                    $this->createVatRate(0, 'zw', 344.82, 0, 344.82),
                    $this->createVatRate(0, 'Total', 1573.04, 221.57, 1794.61),
                ],
            ],
        ];
    }

    private function createProduct(string $name, float $grossPrice, Vat $vat) : Product
    {
        return new Product($name, new Price($grossPrice), $vat);
    }

    private function createVatRate(
        float $vatValueVal,
        string $vatRepresentationVal,
        float $netTotal,
        float $vatValue,
        float $grossValue
    ) : VatRate {
        $vatRef = new ReflectionClass(Vat::class);
        $vat    = $vatRef->newInstanceWithoutConstructor();
        $this->setPropertyValue($vat, 'value', $vatValueVal);
        $this->setPropertyValue($vat, 'representationValue', $vatRepresentationVal);

        $vatRateRef = new ReflectionClass(VatRate::class);
        $vatRate    = $vatRateRef->newInstanceWithoutConstructor();
        $this->setPropertyValue($vatRate, 'vat', $vat);
        $this->setPropertyValue($vatRate, 'netTotal', $netTotal);
        $this->setPropertyValue($vatRate, 'vatValue', $vatValue);
        $this->setPropertyValue($vatRate, 'grossValue', $grossValue);

        return $vatRate;
    }

    /**
     * @param mixed $value
     *
     * @throws ReflectionException
     */
    private function setPropertyValue(object $object, string $name, $value) : void
    {
        $ref         = new ReflectionClass($object);
        $refProperty = $ref->getProperty($name);
        $refProperty->setAccessible(true);
        $refProperty->setValue($object, $value);
    }

    /**
     * @dataProvider roundProvider
     */
    public function testRound(float $value, float $expected) : void
    {
        $actual = round($value, 2);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array<mixed>
     */
    public function roundProvider() : array
    {
        return [
            [
                1.234,
                1.23,
            ],
            [
                1.235,
                1.24,
            ],
            [
                1.236,
                1.24,
            ],
        ];
    }
}
