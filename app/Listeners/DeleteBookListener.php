<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use App\Events\DeleteBookEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteBookListener
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
     * @param  \App\Events\DeleteBookEvent  $event
     * @return void
     */
    public function handle(DeleteBookEvent $event )
    {
        Log::warning('Le livre a été supprimé :' . $event->book->id);
    }
}
