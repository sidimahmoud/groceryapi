<?php

namespace App\Listeners;

use App\Events\PotentialBookingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PotentialBookingListener
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
     * @param  PotentialBookingEvent  $event
     * @return void
     */
    public function handle(PotentialBookingEvent $event)
    {
        //
    }
}
