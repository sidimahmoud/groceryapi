<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\InboxRepository;
use App\Inbox;
use App\User;

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

    public function getRooms() {
        $groups = Inbox::pluck('user_id', 'user_id');
        return $this->getContactsOfGroups($groups);
    }

    public function getContactsOfGroups($groups)
    {
        return User::whereHas('inboxes', function($query) use($groups){
            $query->whereIn('user_id', $groups);
        })->get();
    }
}
