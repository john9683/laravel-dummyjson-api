<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ErrorApiEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param string $uri
     */
    public string $uri;

    /**
     * @param string $method
     */
    public string $method;

    /**
     * @param int $responseStatus
     */
    public int $responseStatus;

    /**
     * @return void
     */
    public function __construct(string $uri, string $method, int $responseStatus)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->responseStatus = $responseStatus;
    }
}
