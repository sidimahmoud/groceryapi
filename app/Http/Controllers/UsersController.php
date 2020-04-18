<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Repository\Eloquent\UserRepository; 
use Illuminate\Http\Request;

class UsersController extends BaseController
{
   private $userRepository;
  
   public function __construct(UserRepository $userRepository)
   {
       $this->userRepository = $userRepository;
   }

    public function index()
    {
        $users = $this->userRepository->all();

        return response()->json($users, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->userRepository->create($request->all());
        return response()->json($user, 201);
    }

    /**
     * Get current user with the app provided
     *
     * @param Request $request
     * @return mixed
     */
    public function current(Request $request)
    {
        $user = $request->user();
        if (empty($user)) {
            return response()->json(
                ['data' => [
                    'user' => $request->all()
                   ]
                ]
            );
        }
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Int $id)
    {
        // This is redundant, I know. But this is the easiest way for now
        // to still use the query builder that's automatically loaded using this method.
        $order = $this->userRepository->findById($id);
        
        return response()->json($order);
    }
 
}