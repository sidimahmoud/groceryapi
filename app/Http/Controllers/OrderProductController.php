<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\OrderProductRespository;

class OrderProductController extends Controller
{
   private $orderRepository;
  
   public function __construct(OrderProductRespository $orderRepository)
   {
       $this->orderRepository = $orderRepository;
   }

    public function index()
    {
        $orders = $this->orderRepository->all();
        return response()->json($orders, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orders = $this->orderRepository->create($request->all());
        return response()->json($orders, 201);
    }
}
