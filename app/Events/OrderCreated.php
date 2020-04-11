<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Order;

class OrderCreated implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     /**
     * @var Order
     */
    public $order;

    /**
     * @var array
     */
    protected $users = [];

    /**
     * BookingEvent constructor.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->users[] = $order->super_market_id;
    }

    /**
     * @return array|Channel|Channel[]
     */

    public function broadcastOn()
    {
        $channels = [
            'order-tracker',
            'order-tracker.'. $this->order->id
        ];

        foreach ($this->users as $user) {
            $channels[] = 'user.' . $user;
        }

        return collect($channels)->map(function ($channel) {
            return new Channel($channel);
        })->toArray();
    }
}
