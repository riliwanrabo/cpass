<?php


namespace App\Services;


/**
 * Class CalculatorService
 * @package App\Services
 */
class CalculatorService
{
    public function __construct(
        public float $amount, public string $duration,
        public int $repaymentDay, public int $interest, public mixed $options = [])
    {
    }

    public function run()
    {

    }

    protected function calculate()
    {

    }

    private function discountFactor($duration)
    {
        $rate = ($this->getRate()) / 12;
        return ($rate * ((1 + $rate) ** $duration)) / (((1 + $rate) ** $duration) - 1);
    }

    private function calculateInterestPerPeriod($amount)
    {
        $rate = $this->getRate();
        return round($amount * ($rate / 12), 2);
    }

    private function calculatePrincipal($paymentAmount, $interest)
    {
        return round(($paymentAmount - $interest), 2);
    }

    private function calculateBalancePerPeriod($initialAmount, $currentPaymentAmount)
    {
        return round(($initialAmount - $currentPaymentAmount), 2);
    }

    private function getRate(): float|int
    {
        return $this->interest / 100;
    }
}
