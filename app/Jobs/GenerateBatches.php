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
        $closest = $this->getClosestMarket();
        $market = SuperMarket::where('id', $closest[0])->first();
        $drivers = DriverData::where('is_in_order', 0)
                               ->where('is_online', 1)->get();
        $marketCoord = explode(',', $market["coordinates"]);
        $order = $this->order;
        
        if(!empty($drivers)){
            foreach($drivers as $key=>$driver){
                $driverCoord = explode(',', $driver["coordinates"]);
                $dist = $this->getTravels($driverCoord,$marketCoord);
                if(!empty($dist) && $dist[0]!=0){
                    $possible_gain = 10;//$this->getGain($dist,$closest);
                    $batch = $this->batchEntryRepository->create([
                        'order_id' => $order->id,
                        'driver_id' => $driver['id'],
                        'super_market_id' => $market['id'],
                        'market_address' => $market['address'],
                        'market_coordinates' => $market['coordinates'],
                        'will_send_at' => Carbon::now()->addSeconds(($key+2)*30),
                        'temp_travel_distance' => $dist[0],
                        'temp_travel_time' => $dist[1],
                        'market_travel_distance' => $closest[1],
                        'market_travel_time' => $closest[2],
                        'total_travel_distance' => number_format(($closest[1] + $dist[0])/1000, 1, '.', ''),
                        'total_travel_time' => intval(($closest[2] + $dist[1])/60),
                        'possible_gains' => $possible_gain,
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

    private function getClosestMarket(){
        $closest_id = 0;
        $closest_distance = 10000000;
        $closest_time = 10000000;

        $order = $this->order;
        $markets = SuperMarket::where('is_test', 0)->get();
        $orderCoord = explode(',', $order["coordinates"]);
        foreach($markets as $key=>$market){
            $marketCoord = explode(',', $market["coordinates"]);
            $dist = $this->getTravels($marketCoord,$orderCoord);
            if(!is_null($dist[0]) && $dist[0]<$closest_distance){
                $closest_id = $market["id"];
                $closest_distance = $dist[0];
                $closest_time = $dist[1];
            }
        }

        return [
            $closest_id,
            $closest_distance,
            $closest_time
        ];
    }

    private function getTravels(array $first = [], array $second = []){
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$first[0],$first[1]&destinations=$second[0],$second[1]&departure_time=now&key=AIzaSyAmGhfMkVv6jEXF4xdtxQZbYJrlqAKokSE";
        $data = @file_get_contents($url);
        $data = json_decode($data,true);

        return [
            $data['rows'][0]['elements'][0]['distance']['value'],
            $data['rows'][0]['elements'][0]['duration']['value']
        ];
    }

    public function getGain(array $first = [], array $second = []){
        $products_count = count($this->order->products);
        //$somme = ($products_count * )+
    }
}
