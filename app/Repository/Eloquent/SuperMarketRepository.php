<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\SuperMarket;

class SuperMarketRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $exactFilters = [
        'id',
        'user_id',
        'address',
        'name',
        'town_id',
        'city',
        'town_name',
        'post_code',
        'coordinates',
        'logo'
    ];

    /**
     * @var array
     */
    protected $allowedIncludes = [
        'categories'
    ];

   /**
    * OrderRepository constructor.
    *
    * @param Order $model
    */
   public function __construct(SuperMarket $model)
   {
       parent::__construct($model);
   }

}