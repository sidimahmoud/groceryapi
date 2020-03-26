<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\ProductRepository;

class ProductController extends Controller
{
   private $productRepository;
  
   public function __construct(ProductRepository $productRepository)
   {
       $this->productRepository = $productRepository;
   }

    public function index()
    {
        $products = $this->productRepository->all();
        return response()->json($products, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $this->productRepository->create($request->all());
        return response()->json($product, 201);
    }
}
