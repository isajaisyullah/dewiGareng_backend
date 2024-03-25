<?php

namespace App\Http\Controllers\API;

use App\Models\Umkm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UmkmResource;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->input('name');

        $query = Umkm::query()->with('user');

        if($name){
            $query->where('name', 'like', '%' . $name . '%');
        }

        $umkms = $query->get();

        if ($umkms->count() === 0) {
            return response()->json(['message' => 'data not found.'], 404);
        }

        return UmkmResource::collection($umkms);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $umkm = Umkm::with('user')->find($id);

        if (!$umkm) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return new UmkmResource($umkm);
    }

    public function UmkmProduct(Request $request, $id)
    {
        $productName = $request->query('product');

        $umkm = Umkm::with(['products' => function ($query) use ($productName) {
            $query->where('name', 'like', '%' . $productName . '%');
        }])->find($id);

        // $umkm = Umkm::with(['products'])->find($id);

        if (!$umkm) {
            return response()->json(['message' => 'data not found'], 404);
        }

        // if the UMKM has no products
        // if ($umkm->products->isEmpty()) {
        //     return response()->json(['message' => 'UMKM has no products'], 404);
        // }

        return new UmkmResource($umkm);
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
