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
        'super_market_id',
        'name'
    ];

    /**
     * @var array
     */
    protected $allowedIncludes = [
        'products'
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