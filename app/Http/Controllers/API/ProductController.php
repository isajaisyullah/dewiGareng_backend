<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->input('name');

        $kategori = $request->input('category');

        $query = Product::query()->with('umkm');

        if($name){
            $query->where('name', 'like', '%' . $name . '%');
        }

        if($kategori){
            $query->where('category_id', $kategori);
        }

        $products = $query->get();

        if ($products->count() === 0) {
            return response()->json(['message' => 'data not found.'], 404);
        }

        return ProductResource::collection($products);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with('umkm.user')->find($id);

        if (!$product) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return new ProductResource($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
