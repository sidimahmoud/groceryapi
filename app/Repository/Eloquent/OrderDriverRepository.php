<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\OrderDriver;

class OrderDriverRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $exactFilters = [
    ];

    /**
     * @var array
     */
    protected $allowedIncludes = [];

    /**
     * @var array
     */
    protected $allowedFilters = [];

   /**
    * OrderDriverRepository constructor.
    *
    * @param OrderDriver $model
    */
   public function __construct(OrderDriver $model)
   {
       parent::__construct($model);
   }

}