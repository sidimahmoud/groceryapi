<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;
use App\DriverData;

class Batche extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'driver_id',
        'will_send_at',
        'sent_at',
        'dispatch_interval',
        'viewable',
        'accepted_at',
        'cancelled_at',
        'rejected_at',
        'temp_travel_distance',
        'temp_travel_time',
        'market_travel_distance',
        'market_travel_time',
        'possible_gains',
        'super_market_id',
        'counter',
        'total_travel_time',
        'total_travel_distance',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo(DriverData::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
        return $this->belongsTo(SuperMarket::class);
    }
}
