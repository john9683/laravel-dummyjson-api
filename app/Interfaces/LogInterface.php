<?php

namespace App\Interfaces;

interface LogInterface
{
    /**
     * @param string $uri
     * @param string|null $title
     * @param int $count
     * @param int $responseStatus
     * @return void
     */
    public function loggerHttpGet(string $uri, ?string $title, int $count, int $responseStatus): void;

    /**
     * @param int $responseStatus
     * @param string $uri
     * @param array $attributes
     * @return void
     */
    public function loggerHttpPost(int $responseStatus, string $uri, array $attributes): void;
}
