<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\MessageRepository;
use App\Message;

class MessageController extends Controller
{
   private $messageRepository;
  
   public function __construct(MessageRepository $messageRepository)
   {
       $this->messageRepository = $messageRepository;
   }

    public function index()
    {
        $messages = $this->messageRepository->all();
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
        $messages = $this->messageRepository->create($request->all());
        return response()->json($messages, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Int $id)
    {
        // This is redundant, I know. But this is the easiest way for now
        // to still use the query builder that's automatically loaded using this method.
        $order = $this->superMarketRepository->findById($id);
        
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DriverData $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuperMarket $superMarket)
    {
        // for some reasons, constructors are executed first before the middleware
        $this->superMarketRepository->setModel($superMarket);
        $data = $this->superMarketRepository->update($request->all());
        return response()->json($data);
    }
}
