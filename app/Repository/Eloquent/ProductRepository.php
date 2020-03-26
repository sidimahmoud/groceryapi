<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\Product;

class ProductRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $exactFilters = [
        'categorie_id',
        'name',
        'image',
        'price'
    ];

    /**
     * @var array
     */
    protected $allowedIncludes = [];

   /**
    * OrderRepository constructor.
    *
    * @param Order $model
    */
   public function __construct(Product $model)
   {
       parent::__construct($model);
   }

}