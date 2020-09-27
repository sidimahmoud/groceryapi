<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\OrderMessageRepository;
use App\Inbox;
use App\User;

class OrderMessageController extends Controller
{
    
   private $orderMessageRepository;
  
   public function __construct(OrderMessageRepository $orderMessageRepository)
   {
       $this->orderMessageRepository = $orderMessageRepository;
   }

    public function index()
    {
        if (request()->has('all')) {
            $messages = $this->orderMessageRepository->get();
        } else {
            $messages = $this->orderMessageRepository->paginate();
        }
        
        return response()->json($messages, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = $this->orderMessageRepository->create($request->all());
        return response()->json($message, 201);
    }
}