<?php   

namespace App\Repository\Eloquent;   

use App\Repository\EloquentRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filter as Filter;
use Spatie\QueryBuilder\QueryBuilder;


class BaseRepository implements EloquentRepositoryInterface 
{     
    /**      
     * @var Model      
    */     
    protected $model;
    /**
     * @var array
     */

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
    protected $exactFilters = [
        'id'
    ];

    /**
     * @var array
     */
    protected $allowedAppends = [];

    /**
     * @var array
     */
    protected $allowedSorts = [];

    /**
     * @var bool
     */
    protected $queryBuilderEnabled = true;


    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }

    /**
     * Set model
     *
     * @param Model|null $model
     */
    public function setModel(?Model $model)
    {
        $this->model = $model;
    }


    /**
    * @return Collection
    */
    public function all(): Collection
    {
        return $this->getQueryBuilderFor(
            $this->getBasicQuery()
        )->get();   
    }
    


    /**
     * @return Builder
     */
    protected function newQuery()
    {
        return $this->model->newQuery();
    }
 
    /**
     * Create model
     *
     * @param array $data
     * @return Model|Builder
     */
    public function create(array $data): Model
    {
        return $this->newQuery()
            ->create($data);
    }
 
    /**
     * Find model by id
     *
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model
    {
        return $this->getQueryBuilderFor(
            $this->newQuery()
        )->findOrFail($id);
    }

    /**
     * Update model
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        return $this->model->update($data);
    }

    /**
     * Delete model
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(): bool
    {
        return $this->model->delete();
    }

    /**
     * Get query builder
     *
     * @param $query
     * @param null $request
     * @return QueryBuilder|Builder
     */
    protected function getQueryBuilderFor($query, $request = null)
    {
        if ($this->queryBuilderEnabled) {
            return QueryBuilder::for($query, $request)
                ->allowedIncludes($this->allowedIncludes)
                ->allowedFilters($this->allowedFilters)
                ->allowedAppends($this->allowedAppends)
                ->allowedSorts($this->allowedSorts);
        } else if (is_string($query)) {
            $query = ($query)::query();
        }

        return $query;
    }

    /**
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function paginateByParams(array $params): LengthAwarePaginator
    {
        return $this->getQueryBuilderFor(
            $this->getBasicQuery()->where($params)
        )->paginate();
    }

    /**
     * @return Builder
     */
    protected function getBasicQuery()
    {
        $query = $this->newQuery();

        // check if search is performed
        if (request()->has('q') && $this->canSearch()) {
            $items = $this->getScoutQuery(
                (get_class($this->model))::search(request()->input('q'))
            )->get();
            $primaryKeys = $items->pluck($this->getPrimaryKey())->toArray();
            $query->whereIn($this->getPrimaryKey(), $primaryKeys);
        }

        return $query;
    }


}