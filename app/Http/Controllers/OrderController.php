<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\OrderRepository;
use App\Order;
use App\OrderRate;

class OrderController extends Controller
{
   private $orderRepository;
  
   public function __construct(OrderRepository $orderRepository)
   {
       $this->orderRepository = $orderRepository;
   }

    public function index()
    {
        if (request()->has('all')) {
            $orders = $this->orderRepository->all();
        } else {
            $orders = $this->orderRepository->paginate();
        }
        
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
        $orders = $this->orderRepository->userOrders($id);
        return response()->json($orders);
    }

    /**
     * Accept the order.
     *
     * @param Order $booking
     * @return \Illuminate\Http\Response
     */
    public function completOrders(Int $id){
        $orders = $this->orderRepository->completOrders($id);
        return response()->json($orders);
    }

    /**
     * Accept the order.
     *
     * @param Order $booking
     * @return \Illuminate\Http\Response
     */
    public function pendingOrders(Int $id){
        $orders = $this->orderRepository->pendingOrders($id);
        return response()->json($orders);
    }

    /**
     * Accept the order.
     *
     * @param Order $booking
     * @return \Illuminate\Http\Response
     */
    public function completOrder(Int $id){
        $order = $this->orderRepository->findById($id);
        $this->orderRepository->setModel($order);
        $orders = $this->orderRepository->completOrder($id);
        return response()->json($orders);
    }
    /**
     * Accept the order.
     *
     * @param Order $booking
     * @return \Illuminate\Http\Response
     */
    public function getReciept(){
        $pdf = $this->orderRepository->getReciept();
        return $pdf->stream("relatorio.pdf", array("Attachment" => false));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DriverData $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // for some reasons, constructors are executed first before the middleware
        $this->orderRepository->setModel($order);
        $data = $this->orderRepository->update($request->all());
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DriverData $driver
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request, Order $order)
    {
        // for some reasons, constructors are executed first before the middleware
        /*$this->orderRepository->setModel($order);
        $data = $this->orderRepository->rate($request->all());*/
        $data = OrderRate::create($request->all());
        return response()->json($data);
    }
    
}
