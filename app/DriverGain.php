<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;
use App\DriverData;

class DriverGain extends Model
{
    protected $fillable = [
        'order_id',
        'driver_data_id',
        'amount',
        'tips',
        'total',
        'day',
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
