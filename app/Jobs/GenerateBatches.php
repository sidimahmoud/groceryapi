<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use App\SuperMarket;
use App\DriverData;
use App\Repository\Eloquent\BatcheRepository;
use App\Order;
use Illuminate\Support\Facades\Log;

class GenerateBatches implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    /**
     * @var Array
     */
    public $data = [];

    /**
     * @var Order
     */
    public $order;

     /**
     * @var BatcheRepository;
     */
    private $batchEntryRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data = [], Order $order, BatcheRepository $batchEntryRepository)
    {
        $this->data = $data;
        $this->order = $order;
        $this->batchEntryRepository = $batchEntryRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $market = SuperMarket::where('id', $this->data['super_market_id'])->first();
        $drivers = DriverData::where('has_course', '=', false)
                               ->where('available', '=', true)->get();
        $marketCoord = explode(',', $market["coordinates"]);
        $order = $this->order;
        info("here generate batches");
        if(!empty($drivers)){
            info("not empty drivers");
            foreach($drivers as $key=>$driver){
                $driverCoord = explode(',', $driver["coordinates"]);
                $dist = $this->geoLocation($driverCoord,$marketCoord);
                if($dist!=0){
                    $this->batchEntryRepository->create([
                        'order_id' => $order->id,
                        'driver_id' => $driver['id'],
                        'will_send_at' => Carbon::now()->addSeconds(($key+2)*30),
                        'temp_travel_distance' => $dist
                   ]);
                }
            }
            
            $this->batchEntryRepository->executeFirstBatch($order->id);
        }else {
            info('no_matching_drivers');
        }
    }

    private function geoLocation(array $first = [], array $second = []){
        if (($first[0] == $first[1]) && ($second[0] == $second[1])) {
            return 0;
        }
        else {
            $theta = $first[1]- $second[1];
            $dist = sin(deg2rad($first[0])) * sin(deg2rad($second[0])) +  cos(deg2rad($first[0])) * cos(deg2rad($second[0])) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            
            return ($miles * 1.609344);
        }
    }
}
