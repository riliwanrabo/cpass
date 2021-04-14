<?php

namespace App\Traits;

use App\Helpers\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ValidationTrait
{
    public function authorize()
    {
        return true;
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator): void
    {
        $response = $this->formatResponse()
            ->responder($validator->errors()->all(), 422, 'Validation Error');
        throw new HttpResponseException($response);
    }


    private function formatResponse(): Response
    {
        return (new Response());
    }
}
