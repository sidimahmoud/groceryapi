<?php

namespace App\Modules\Products\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FilterByCategorie implements Filter
{
    /**
     * @param Builder $query
     * @param $value
     * @param string $property
     * @return Builder
     */
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        $query->where('categorie_id', $value);

        return $query;
    }
}
