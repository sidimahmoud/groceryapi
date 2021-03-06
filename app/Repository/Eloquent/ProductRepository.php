<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\Product;
use App\Modules\Products\Filters\FilterByCategorie;
use Spatie\QueryBuilder\AllowedFilter;

class ProductRepository extends BaseRepository
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
     * @var array
     */
    protected $allowedSorts = [
        'price',
    ];

   /**
    * OrderRepository constructor.
    *
    * @param Order $model
    */
   public function __construct(Product $model)
   {
       parent::__construct($model);
       $this->allowedFilters[] = AllowedFilter::custom('categorie', new FilterByCategorie());
   }

   /**
     * Update model
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        return Product::where('id', '=', $data['id'] )
                ->update($data);
    }

}