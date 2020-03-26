<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SuperMarket;
use App\Product;

class Categorie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'super_market_id',
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supermarket()
    {
        return $this->belongsTo(SuperMarket::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }



}
