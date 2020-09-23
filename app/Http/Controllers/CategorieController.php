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
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Categorie $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
        // for some reasons, constructors are executed first before the middleware
        $this->categorieRepository->setModel($categorie);
        $data = $this->categorieRepository->update($request->all());
        return response()->json($data);
    }

    /**
     * destroy the specified resource in storage.
     *
     * @param Request $request
     * @param DriverData $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $categorieId)
    {
        $categorie = $this->categorieRepository->findById($categorieId);
        // for some reasons, constructors are executed first before the middleware
        $this->categorieRepository->setModel($categorie);
        $data = $this->categorieRepository->delete();
        return response()->json($data);
    }
}
