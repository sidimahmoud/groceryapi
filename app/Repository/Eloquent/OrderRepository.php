<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\Order;

class OrderRepository extends BaseRepository
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
        'products.product'
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
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    /**
     * Create translator
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $order = parent::create($data);
        $this->setModel($order);
        $this->saveMetaData($data);
        return $order;
    }

    /**
     * Save translator meta data
     *
     * @param array $data
     */
    private function saveMetaData(array $data = [])
    {
        // check if products are set
        if (!empty($data['products'])) {
            info($data['products']);
            foreach($data['products'] as $product) {
                $this->model->products()->create($product);
            }
        }

    }

}