<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use App\Events\CreateBookEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class CreateBookListener
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
     * @param  \App\Events\CreateBookEvent  $event
     * @return void
     */
    public function handle(CreateBookEvent $event)
    {
        Log::info('Un nouveau livre a été ajouté avec l\'id: ' . $event->book->id);

    }
}
