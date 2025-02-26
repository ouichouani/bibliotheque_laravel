<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use App\Events\ReadBookEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReadBookListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ReadBookEvent  $event
     * @return void
     */
    public function handle(ReadBookEvent $event)
    {
        log::info('vous aver en livre ' . $event->book->id) ;
    }
}
