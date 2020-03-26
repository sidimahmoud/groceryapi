<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\Order;

class OrderRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $exactFilters = [
        'language',
        'address',
        'town_id',
        'client_id',
        'supermarket_id',
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
     * @var array
     */
    protected $allowedIncludes = [
        'products.product'
    ];

   /**
    * OrderRepository constructor.
    *
    * @param Order $model
    */
   public function __construct(Order $model)
   {
       parent::__construct($model);
   }

}