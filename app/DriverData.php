<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class DriverData extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address',
        'name',
        'town_id',
        'city',
        'town_name',
        'post_code',
        'coordinates',
        'image',
        'tax',
        'tax_type',
        'bank_name',
        'bank_account_number',
        'has_training_certificate',
        'has_police_background',
        'has_contract',
        'has_driving_license',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
