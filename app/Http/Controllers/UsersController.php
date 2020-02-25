<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Repository\UserRepositoryInterface; 
use Illuminate\Http\Request;

class UsersController extends BaseController
{
   private $userRepository;
  
   public function __construct(UserRepositoryInterface $userRepository)
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
 
}