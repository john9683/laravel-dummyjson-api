<?php

namespace App\Listeners;

use App\Events\ErrorApiEvent;
use App\Jobs\ErrorApiMailJob;

class ErrorApiOccurred
{
    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param ErrorApiEvent $event
     * @return void
     */
    public function handle(ErrorApiEvent $event): void
    {
        ErrorApiMailJob::dispatch($event);
    }
}
