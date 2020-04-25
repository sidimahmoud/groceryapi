<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\OrderRepository;
use App\Order;

class OrderController extends Controller
{
   private $orderRepository;
  
   public function __construct(OrderRepository $orderRepository)
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
        $order = $this->orderRepository->findById($id);
        
        return response()->json($order);
    }

    /**
     * Accept the order.
     *
     * @param Order $booking
     * @return \Illuminate\Http\Response
     */
    public function accept(Int $id,Request $request){
        $order = $this->orderRepository->findById($id);
        $this->orderRepository->setModel($order);
        $this->orderRepository->accept($request->all());
        return response()->json([
            'status' => 'success'
        ]);
    }
    /**
     * Accept the order.
     *
     * @param Order $booking
     * @return \Illuminate\Http\Response
     */
    public function userOrders(Int $id){
        $order = $this->orderRepository->findById($id);
        $this->orderRepository->setModel($order);
        $orders = $this->orderRepository->userOrders($id);
        return response()->json($orders);
    }
}
