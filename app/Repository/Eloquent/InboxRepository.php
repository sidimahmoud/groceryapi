<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use App\Inbox;
use App\Events\MessageEvent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class InboxRepository extends BaseRepository
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
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
    ];

   /**
    * OrderRepository constructor.
    *
    * @param Order $model
    */
    public function __construct(Inbox $model)
    {
        parent::__construct($model);
    }

    /**
     * Create message
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $inbox = parent::create($data);
        $this->setModel($inbox);
        
        //event(new MessageEvent($inbox));
        
        return $inbox;
    }
    
}