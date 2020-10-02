<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Eloquent\ProductRepository;
use App\Product;

class ProductController extends Controller
{
   private $productRepository;
  
   public function __construct(ProductRepository $productRepository)
   {
       $this->productRepository = $productRepository;
   }

    public function index()
    {
        if (request()->has('all')) {
            $products = $this->productRepository->all();
        } else {
            $products = $this->productRepository->paginate();
        }
        
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

    /**
     * Display the specified resource.
     *
     * @param int $productId
     * @return \Illuminate\Http\Response
     */
    public function show(int $productId)
    {
        $product = $this->productRepository->findById($productId);
        $this->productRepository->setModel($product);
        return response()->json($product, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DriverData $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // for some reasons, constructors are executed first before the middleware
        $this->productRepository->setModel($product);
        $data = $this->productRepository->update($request->all());
        return response()->json($data);
    }

    /**
     * Udestroypdate the specified resource in storage.
     *
     * @param Request $request
     * @param DriverData $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // for some reasons, constructors are executed first before the middleware
        $this->productRepository->setModel($product);
        $data = $this->productRepository->delete();
        return response()->json($data);
    }
}
