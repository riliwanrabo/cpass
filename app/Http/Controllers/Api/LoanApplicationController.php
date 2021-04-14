<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanApplication\CalculatorRequest;
use App\Services\CalculatorService;
use Illuminate\Http\Request;

class LoanApplicationController extends Controller
{
    protected const GENERAL_EXP_MSG = 'Something went wrong';

    public function calculate(CalculatorRequest $request)
    {
        $amount = $request->get('amount');
        $duration = $request->get('duration');
        $interest = $request->get('interest');
        $repaymentDay = $request->get('repayment_day');
        $calculatorService = (new CalculatorService($amount, $duration, $repaymentDay, $interest));
        try {
            $data = $calculatorService->run();
        } catch (\Exception $e) {
            return $this->responseHelper()->responder([], 400, self::GENERAL_EXP_MSG . 'Error Code: ' . $e->getCode());
        }

        return $this->responseHelper()->responder($data, 200);
    }
}
