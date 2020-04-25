<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\DriverData;
use League\Fractal\TransformerAbstract;
use App\Transformers\DriverTransformer;
use Spatie\QueryBuilder\AllowedFilter;

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
        'user',
        'gains',
        'orders.order'
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
       $this->allowedFilters[] = AllowedFilter::scope('daily_driver');
   }

   /**
     * @return TransformerAbstract
     */
    public function getTransformer(): TransformerAbstract
    {
        return new DriverTransformer;
    }

    /**
     * @return string
     */
    public function getResourceKey(): string
    {
        return 'drivers';
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
        return DriverData::where('id', '=', $data['id'] )
                ->update($data);
    }

}