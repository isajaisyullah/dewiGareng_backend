<?php

namespace App\Http\Controllers\API;

use App\Models\Paket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaketResource;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->input('name');

        $query = Paket::query();

        if($name){
            $query->where('name', 'like', '%' . $name . '%');
        }

        $wisatas = $query->with('wisata')->get();

        return PaketResource::collection($wisatas);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $wisata = Paket::with('wisata')->find($id);

        if (!$wisata) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return new PaketResource($wisata);
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
