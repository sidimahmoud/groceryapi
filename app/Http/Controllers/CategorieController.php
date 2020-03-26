<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\CategorieRepository;

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
}
