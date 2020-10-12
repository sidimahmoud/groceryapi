<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderRate extends Model
{
    
    protected $fillable = [
        'order_id',
        'from_client',
        'from_driver',
        'rate',
        'message',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
