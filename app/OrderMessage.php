<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMessage extends Model
{

    protected $fillable = [
        'order_id',
        'from_user',
        'from_driver',
        'from_admin',
        'message',
        'content',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
}
