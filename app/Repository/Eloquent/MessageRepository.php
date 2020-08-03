<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use App\Message;
use App\Events\MessageEvent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MessageRepository extends BaseRepository
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
    public function __construct(Message $model)
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
        $message = parent::create($data);
        $this->setModel($message);
        
        event(new MessageEvent($message));
        info('$message');
        info($message);
        return $message;
    }
    
}