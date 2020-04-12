<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\BatcheRepository;
use App\Batche;

class BatcheController extends Controller
{
   private $batcheRepository;
  
   public function __construct(BatcheRepository $batcheRepository)
   {
       $this->batcheRepository = $batcheRepository;
   }

    public function index()
    {
        $orders = $this->batcheRepository->all();
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
        $orders = $this->batcheRepository->create($request->all());
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
        $order = $this->batcheRepository->findById($id);
        
        return response()->json($order);
    }

    public function troncate() {
        $data = Batche::truncate();

        return response()->json([]);;
    }
}