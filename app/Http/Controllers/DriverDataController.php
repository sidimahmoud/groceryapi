<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\DriverRepository;
use App\DriverData;

class DriverDataController extends Controller
{
    private $driverRepository;
  
   public function __construct(DriverRepository $driverRepository)
   {
       $this->driverRepository = $driverRepository;
   }

    public function index()
    {
        $drivers = $this->driverRepository->all();
        return response()->json($drivers, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $driver = $this->driverRepository->create($request->all());
        return response()->json($driver, 201);
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
        $driver = $this->driverRepository->findById($id);
        return response()->json($driver);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DriverData $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DriverData $driver)
    {
        // for some reasons, constructors are executed first before the middleware
        $this->driverRepository->setModel($driver);
        $data = $this->driverRepository->update($request->all());
        return response()->json($data);
    }
}
