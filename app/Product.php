<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categorie;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categorie_id',
        'name',
        'image',
        'price',
        'name_english',
        'size',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
