<?php


namespace App\Services;


use Carbon\Carbon;
use JetBrains\PhpStorm\Pure;

/**
 * Class CalculatorService
 * @package App\Services
 */
class CalculatorService
{
    public function __construct(
        public float $amount, public int $duration,
        public int $repaymentDay, public float $interest, public mixed $options = [])
    {
    }

    public function run(): array
    {
        $amount = $this->amount;
        $duration = $this->duration;
        return $this->calculate($amount, $duration);
    }

    /**
     * @param $amount
     * @param $duration
     * @return array
     */
    protected function calculate($amount, $duration): array
    {
        $initialAmount = $this->amount;
        $totalPrincipal = 0;
        $totalInterest = 0;
        $totalPayment = 0;
        $pmt = round($amount * $this->discountFactor($duration), 2);
        $schedule = [];
        for ($d = 0; $d < $duration; $d++) {
            $interest = $this->calculateInterestPerPeriod((float)$amount);
            $principal = $this->calculatePrincipal($pmt, $interest);
            $balance = $this->calculateBalancePerPeriod($amount, $principal);
            $repaymentDay = $this->repaymentDay;
            if ($d === 0) {
                $due_date = Carbon::now()->addMonth()->startOfMonth()->addDays($repaymentDay - 1)->toDateString();
            } else {
                $due_date = Carbon::parse($schedule[$d - 1]['repayment_date'])->addMonth()->startOfMonth()->addDays($repaymentDay - 1)->toDateString();
            }

            $breakdown = [
                'payment' => $pmt,
                'repayment_date' => $due_date
            ];

            $schedule[] = $breakdown;
            $totalPrincipal += $principal;
            $totalPayment += $pmt;
            $amount = $balance;
        }

        return [
            'total_repayment' => round($totalPayment, 2),
            'schedule' => $schedule,
            'rate' => $this->getRate() * 100,
            'loan_amount' => $initialAmount,
            'duration' => $duration . ' months',


        ];
    }

    /**
     * @param int $duration
     * @return float|int
     */
    protected function discountFactor(int $duration): float|int
    {
        $rate = ($this->getRate()) / 12;
        return ($rate * ((1 + $rate) ** $duration)) / (((1 + $rate) ** $duration) - 1);
    }

    /**
     * @param float $amount
     * @return float
     */
    protected function calculateInterestPerPeriod(float $amount): float
    {
        $rate = $this->getRate();
        return round($amount * ($rate / 12), 2);
    }

    /**
     * @param float $paymentAmount
     * @param float $interest
     * @return float
     */
    private function calculatePrincipal(float $paymentAmount, float $interest): float
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
