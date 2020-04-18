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
    ];

    /**
     * @var array
     */
    protected $allowedIncludes = [
        'categories'
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
   public function __construct(SuperMarket $model)
   {
       parent::__construct($model);
   }

   //Work arround for update fonction not the final solution
    /**
     * Update model
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        return SuperMarket::where('id', '=', $data['id'] )
                ->update($data);
    }

}