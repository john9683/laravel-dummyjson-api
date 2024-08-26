<?php

namespace App\Mail;

use AllowDynamicProperties;
use Illuminate\Mail\Mailable;

#[AllowDynamicProperties]
class ErrorApiMail extends Mailable
{
    public function __construct(string $uri, string $method, int $responseStatus)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->responseStatus = $responseStatus;
    }

    /**
     * @return $this
     */
    public function build(): static
    {
        return $this->subject('API: возникла ошибка')
            ->view('mail.error_api', [
                'uri' =>  $this->uri,
                'method' =>  $this->method,
                'responseStatus' =>  $this->responseStatus,
            ]);
    }
}
