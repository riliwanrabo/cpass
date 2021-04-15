<?php

namespace App\Traits;


use Illuminate\Support\Facades\Http;

trait CurlTrait
{
    public function postApi($endpoint, $data, $headers = [])
    {
        return Http::withHeaders(array_merge($headers, $this->mainHeaders()))
            ->post($endpoint, $data);
    }


    public function getApi($endpoint, $query = [], $headers = [])
    {
        return Http::withHeaders(array_merge($headers, $this->mainHeaders()))
            ->get($endpoint, $query);
    }

    public function putApi($endpoint, $data, $headers = [])
    {
        return Http::withHeaders(array_merge($headers, $this->mainHeaders()))
            ->put($endpoint, $data);
    }

    /**
     * set main headers for http request
     *
     * @return array
     */
    protected function mainHeaders(): array
    {
        return [
            'Content-Type: application/json',
            "Cache-Control: no-cache",
        ];
    }
}
