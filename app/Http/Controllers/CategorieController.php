<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\CategorieRepository;
use App\Categorie;

class CategorieController extends Controller
{
    private $categorieRepository;
  
   public function __construct(CategorieRepository $categorieRepository)
   {
       $this->categorieRepository = $categorieRepository;
   }

    public function index()
    {
        $categories = $this->categorieRepository->all();

        return response()->json($categories, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categorie = $this->categorieRepository->create($request->all());
        return response()->json($categorie, 201);
    }

    /**
     * destroy the specified resource in storage.
     *
     * @param Request $request
     * @param DriverData $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        info('$categorie');
        info($categorie);
        // for some reasons, constructors are executed first before the middleware
        $this->categorieRepository->setModel($categorie);
        $data = $this->categorieRepository->delete();
        return response()->json($data);
    }
}
