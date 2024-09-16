<?php

namespace App\Services;

use App\Interfaces\HttpInterface;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class HttpService implements HttpInterface
{
    /**
     * @param int $times
     * @param int $sleep
     * @param string $uri
     * @return Response|PromiseInterface
     */
    public function httpGet(int $times, int $sleep, string $uri): Response|PromiseInterface
    {
        return Http::retry($times, $sleep)->get($uri);
    }

    /**
     * @param int $times
     * @param int $sleep
     * @param string $uri
     * @param array $data
     * @return Response|PromiseInterface
     */
    public function httpPost(int $times, int $sleep, string $uri, array $data): Response|PromiseInterface
    {
        return Http::retry($times, $sleep)->post($uri, $data);
    }
}
