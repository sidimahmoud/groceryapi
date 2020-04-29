<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\DriverGainRepository;

class DriverGainController extends Controller
{
   private $driverGainRepository;
  
   public function __construct(DriverGainRepository $driverGainRepository)
   {
       $this->driverGainRepository = $driverGainRepository;
   }

   /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $driverGain = $this->driverGainRepository->create($request->all());
        return response()->json($driverGain, 201);
    }
}
