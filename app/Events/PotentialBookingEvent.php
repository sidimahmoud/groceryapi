<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Batche;
use App\Order;

class PotentialBookingEvent implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Batche
     */
    public $batch;

    /**
     * @var array
     */
    protected $users = [];

    public $order;

    /**
     * BookingEvent constructor.
     *
     * @param Order $order
     */
    public function __construct(Batche $batch)
    {
        $this->batch = $batch;
        $this->users[] = $batch->driver_id;
    }

    /**
     * @return array|Channel|Channel[]
     */

    public function broadcastOn()
    {
        $channels = [];

        foreach ($this->users as $user) {
            $channels[] = 'user.' . $user;
        }

        // execute next batch
        info('potential booking event sent +1');
        info($channels);
        return collect($channels)->map(function ($channel) {
            return new Channel($channel);
        })->toArray();
    }
}
