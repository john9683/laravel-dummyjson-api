<?php

namespace App\Interfaces;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

interface HttpInterface
{
    /**
     * @param int $times
     * @param int $sleep
     * @param string $uri
     * @return Response|PromiseInterface
     */
    public function httpGet(int $times, int $sleep, string $uri): Response|PromiseInterface;

    /**
     * @param int $times
     * @param int $sleep
     * @param string $uri
     * @param array $data
     * @return Response|PromiseInterface
     */
    public function httpPost(int $times, int $sleep, string $uri, array $data): Response|PromiseInterface;
}
