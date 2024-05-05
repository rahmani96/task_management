<?php

namespace App\Listeners;

use App\Events\SharedTask;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SharedTaskListener
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
     * @param  \App\Events\SharedTask  $event
     * @return void
     */
    public function handle(SharedTask $event)
    {
        //
    }
}
