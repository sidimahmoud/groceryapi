<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\DriverData;

class DriverRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $exactFilters = [];

    /**
     * @var array
     */
    protected $allowedIncludes = [
        'user'
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [];

   /**
    * OrderRepository constructor.
    *
    * @param Order $model
    */
   public function __construct(DriverData $model)
   {
       parent::__construct($model);
   }

}