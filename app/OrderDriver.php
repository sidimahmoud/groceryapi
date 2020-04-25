<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;
use App\DriverData;

class OrderDriver extends Model
{

    protected $fillable = [
        'order_id',
        'driver_data_id',
        'name',
        'gender',
        'email',
        'mobile',
        'cancelled_at',
        'temp_travel_time',
        'temp_travel_distance',
        'is_late',
        'delay_time',
        'accepted_at',
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
}
