<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\InboxRepository;
use App\Inbox;

class InboxController extends Controller
{
   private $inboxRepository;
  
   public function __construct(InboxRepository $inboxRepository)
   {
       $this->inboxRepository = $inboxRepository;
   }

    public function index()
    {
        $messages = $this->inboxRepository->all();
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
        $messages = $this->inboxRepository->create($request->all());
        return response()->json($messages, 201);
    }
}
