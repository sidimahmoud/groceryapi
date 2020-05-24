<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;
use App\Order;
use App\SuperMarket;
use App\DriverData;
use App\Events\OrderCreated;
use App\Events\PotentialBookingEvent;
use Carbon\Carbon;
use App\Repository\Eloquent\BatcheRepository;
use App\Jobs\GenerateBatches;
use Illuminate\Support\Facades\Log;

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
        'products.product',
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
    ];

    /**
     * @var BatcheRepository;
     */
    private $batchEntryRepository;

   /**
    * OrderRepository constructor.
    *
    * @param Order $model
    */
    public function __construct(Order $model, BatcheRepository $batchEntryRepository)
    {
        parent::__construct($model);
        $this->batchEntryRepository = $batchEntryRepository;
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
        $this->saveProducts($data);
        //$this->generateBatches($data, $order);
        Log::info("here repository");
        $executeJob = new GenerateBatches($data,$order,$this->batchEntryRepository);
        dispatch($executeJob);
        event(new OrderCreated($order));
        return $order;
    }

    /**
     * Save translator meta data
     *
     * @param array $data
     */
    private function saveProducts(array $data = [])
    {
        // check if products are set
        if (!empty($data['products'])) {
            foreach($data['products'] as $product) {
                $this->model->products()->create($product);
            }
        }

    }

    /**
     * Create Batches
     *
     * @param array $data
     */
    private function generateBatches(array $data = [], Order $order)
    {
        $market = SuperMarket::where('id', $data['super_market_id'])->first();
        $drivers = DriverData::where('town_id', $data['town_id'])
                               ->where('has_contract', '=', false)->get();
        $marketCoord = explode(',', $market["coordinates"]);
        
        if(!empty($drivers)){
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

    /**
     * Accept the order.
     *
     * @param Order $order  
     * @return \Illuminate\Http\Response
     */
    public function accept(array $data){
        // change the booking status to assign to prevent another translator from accepting it
        $this->model->update([
            'status_id' => Order::STATUS['assigned']
        ]);
        $data['accepted_at'] = Carbon::now()->format('Y-m-d H:i:s');
        $translator = $this->model->driver()->create($data);
        
    }

    /**
     * Accept the order.
     *
     * @param Int $int  
     * @return \Illuminate\Http\Response
     */
    public function userOrders(Int $id){
        $query = $this->newQuery()
            ->where('client_id', '=', $id)
            ->where('status_id', '<', 4);
        
        return $this->getQueryBuilderFor($query)
            ->get();
    }

    /**
     * Accept the order.
     *
     * @param Int $int  
     * @return \Illuminate\Http\Response
     */
    public function completOrders(Int $id){
        $query = $this->newQuery()
            ->where('super_market_id', '=', $id)
            ->where('status_id', '=', 4);
        
        return $this->getQueryBuilderFor($query)
            ->get();
    }

    /**
     * Accept the order.
     *
     * @param Int $int  
     * @return \Illuminate\Http\Response
     */
    public function pendingOrders(Int $id){
        $query = $this->newQuery()
            ->where('super_market_id', '=', $id)
            ->where('status_id', '<', 3);
        
        return $this->getQueryBuilderFor($query)
            ->get();
    }

    /**
     * Accept the order.
     *
     * @param Order $order  
     * @return \Illuminate\Http\Response
     */
    public function completOrder(Int $id){
        // change the booking status to assign to prevent another translator from accepting it
        $order = $this->model->update([
            'status_id' => Order::STATUS['completed']
        ]);

        return $order;
    }

    
    
}