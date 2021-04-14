<?php

namespace App\Http\Requests\LoanApplication;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CalculatorRequest extends FormRequest
{
    use ValidationTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => ['required', 'numeric', 'min:1000', 'max:5000000',],
            'interest' => ['required', 'min:5', 'max:5', 'numeric'],
            'duration' => ['required', 'numeric', 'min:1', 'max:12',],
            'repayment_day' => ['required', 'min:1', 'max:28', 'numeric']
        ];
    }
}
