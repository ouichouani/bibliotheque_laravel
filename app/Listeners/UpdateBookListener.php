<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use App\Events\UpdateBookEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateBookListener
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
     * @param  \App\Events\UpdateBookEvent  $event
     * @return void
     */
    public function handle(UpdateBookEvent $event)
    {
        Log::info('Le livre a été mis à jour :' . $event->book->id);

    }
}
