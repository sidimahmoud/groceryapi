<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repository\Eloquent\BatcheRepository;
use Carbon\Carbon;
use App\Events\PotentialBookingEvent;

class ExecuteBatchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $batchId;

    /**
     * ExecuteBatchJob constructor.
     *
     * @param int $batchId
     */
    public function __construct(int $batchId)
    {
        $this->batchId = $batchId;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(BatcheRepository $batchRepository)
    {
        /** @var Batch $batch */
        $batch = $batchRepository->findById($this->batchId);
        
        if ($batch->order->isPending()) {
            // set batches as sent
            
            $batchRepository->setModel($batch);
            $batchRepository->update([
                'sent_at' => Carbon::now(),
                'counter' => $batch->counter + 1
            ]);
            
            event(new PotentialBookingEvent($batch));

            // execute next batch
            info('excuted batch +1');
            if ($batchRepository->hasExecutableBatch($batch->order_id)) {
                $batchRepository->executeNextBatch($batch->order_id);
            }
        }
    }
}
