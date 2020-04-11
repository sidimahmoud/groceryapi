<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\Categorie;

class CategorieRepository extends BaseRepository
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
        'products'
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'super_market_id',
        'name'
    ];

   /**
    * OrderRepository constructor.
    *
    * @param Categorie $model
    */
   public function __construct(Categorie $model)
   {
       parent::__construct($model);
   }

}