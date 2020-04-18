<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\SuperMarketRepository;

class SuperMarketController extends Controller
{
   private $superMarketRepository;
  
   public function __construct(SuperMarketRepository $superMarketRepository)
   {
       $this->superMarketRepository = $superMarketRepository;
   }

    public function index()
    {
        $markets = $this->superMarketRepository->all();
        return response()->json($markets, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $market = $this->superMarketRepository->create($request->all());
        return response()->json($market, 201);
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
}
