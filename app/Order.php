<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\OrderProduct;

class Order extends Model
{
    const STATUS = [
        'pending' => 1,
        'assigned' => 2,
        'started' => 3,
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
        'expiry'
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
        info("ici avant");
        return $this->hasMany(OrderProduct::class);
    }

}
