<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\Batche;
use App\Jobs\ExecuteBatchJob;
use Carbon\Carbon;

class BatcheRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $exactFilters = [];

    /**
     * @var array
     */
    protected $allowedIncludes = [
        'order',
        'driver'
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
   public function __construct(Batche $model)
   {
       parent::__construct($model);
   }

    /**
     * Execute first batch
     *
     * @param int $bookingId
     */
    public function executeFirstBatch(int $orderId)
    {
        $batch = $this->getFirstBatch($orderId);
        if ($batch) {
            $this->executeBatch($batch);
        }
    }

    /**
     * Get first batch by booking id
     *
     * @param int $bookingId
     * @return Batch|Model|null
     */
    public function getFirstBatch(int $orderId): ?Batche
    {
        $query = $this->newQuery()
            ->where('order_id', $orderId)
            ->where('counter', "<" , 2);
            //->whereNull('sent_at');

        return $query->orderBy('temp_travel_distance', 'asc')
            ->first();
    }

    /**
     * Execute the batch
     *
     * @param Batche $batch
     */
    public function executeBatch(Batche $batch)
    {
        $executeJob = new ExecuteBatchJob($batch->id);
        $executeJob->delay(Carbon::now()->addSeconds(40));
        dispatch($executeJob);
    }

    /**
     * Check whether there is still not execute batch for the booking
     *
     * @param int $bookingId
     * @return bool
     */
    public function hasExecutableBatch(int $bookingId): bool
    {
        return $this->newQuery()
                ->where('order_id', $bookingId)
                ->where('counter', "<" , 2)
                ->count() > 0;
                //->whereNull('sent_at')
                //->count() > 0;
    }

     /**
     * Execute next batch
     */
    public function executeNextBatch(int $orderId)
    {
        return $this->executeBatch($this->getFirstBatch($orderId));
    }

    /**
     * Find model by id
     *
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model
    {
        return Batche::with('order.products.product')->findOrFail($id);
    }

}