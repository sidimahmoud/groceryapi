<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\OrderProduct;
use App\OrderDriver;
use App\DriverGain;

class Order extends Model
{
    const STATUS = [
        'pending' => 1,
        'assigned' => 2,
        'pickedup' => 3,
        'completed' => 4,
        'cancelled' => 5,
        'expired' => 6
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language',
        'address',
        'town_id',
        'client_id',
        'super_market_id',
        'livreur_id',
        'is_immediate',
        'instructions',
        'start_date',
        'manually_handled',
        'mobile',
        'phone',
        'status_id',
        'completed_at',
        'cancelled_at',
        'is_test',
        'booker_name',
        'coordinates',
        'expiry',
        'amount',
        'tips',
        'created_at',
        'post_code',
        'address_complement',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supermarket()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function livreur()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->status_id == self::STATUS['pending'];
    }

    /**
     * @return bool
     */
    public function isAssigned(): bool
    {
        return $this->status_id == self::STATUS['assigned'];
    }

    /**
     * @return bool
     */
    public function isCancelled(): bool
    {
        return $this->status_id == self::STATUS['cancelled'];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function driver()
    {
        return $this->hasOne(OrderDriver::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function driverGain()
    {
        return $this->hasOne(DriverGain::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function messages()
    {
        return $this->hasMany(OrderMessage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function rates()
    {
        return $this->hasMany(OrderRate::class);
    }
    
}
