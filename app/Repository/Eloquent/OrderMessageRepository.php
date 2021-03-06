<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\OrderMessage;

class OrderMessageRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $exactFilters = [];

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
    * @param OrderMessage $model
    */
   public function __construct(OrderMessage $model)
   {
       parent::__construct($model);
   }

}