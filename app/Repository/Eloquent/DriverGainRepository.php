<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\DriverGain;

class DriverGainRepository extends BaseRepository
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
    * DriverGainRepository constructor.
    *
    * @param DriverGain $model
    */
   public function __construct(DriverGain $model)
   {
       parent::__construct($model);
   }

}