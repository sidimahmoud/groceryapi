<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\OrderProduct;

class OrderProductRespository extends BaseRepository
{

    /**
     * @var array
     */
    protected $exactFilters = [
        'order_id',
        'product_id',
        'quantity',
        'total'
    ];

    /**
     * @var array
     */
    protected $allowedIncludes = [];

   /**
    * OrderRepository constructor.
    *
    * @param Categorie $model
    */
   public function __construct(OrderProduct $model)
   {
       parent::__construct($model);
   }

}