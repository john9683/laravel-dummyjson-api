<?php

namespace App\Jobs;

use App\Events\ErrorApiEvent;
use App\Mail\ErrorApiMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ErrorApiMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var ErrorApiEvent $event
     */
    private ErrorApiEvent $event;

    /**
     * @return void
     */
    public function __construct(ErrorApiEvent $event)
    {
        $this->event = $event;
    }

    /**
     * @return void
     */
    public function handle()
    {
        Mail::to(env('API_ERROR_MAIL'))->send(
            new ErrorApiMail($this->event->uri, $this->event->method, $this->event->responseStatus)
        );
    }
}
