<?php

namespace Tests;

use App\Helpers\AmountCalculator;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class CalculatorTest extends TestCase
{
    private AmountCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new AmountCalculator();
    }

    /**
     * @dataProvider calculationParamsProvider
     */
    public function testCalculation($amount, $rate, $currency, $isEuro, $expected): void
    {
        assertEquals($this->calculator->calculate($amount, $rate, $currency, $isEuro), $expected);
    }

    public function calculationParamsProvider(): array
    {
        return [
            [
                'amount' => 100,
                'rate' => 1,
                'currency' => 'EUR',
                'isEuro' => true,
                'expected' => 1,
            ],
            [
                'amount' => 2000.00,
                'rate' => 0.844639,
                'currency' => 'GBP',
                'isEuro' => true,
                'expected' => 23.68,
            ],
            [
                'amount' => 50.00,
                'rate' => 1.108463,
                'currency' => 'USD',
                'isEuro' => false,
                'expected' => 0.9,
            ],
        ];
    }
}