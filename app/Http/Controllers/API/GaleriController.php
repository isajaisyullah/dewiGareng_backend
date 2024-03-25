<?php

namespace App\Http\Controllers\API;

use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GaleriResource;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');

        $query = Galeri::query();

        if($title){
            $query->where('title', 'like', '%' . $title . '%');
        }

        $galeri = $query->get();

        if ($galeri->count() === 0) {
            return response()->json(['message' => 'data not found.'], 404);
        }

        return GaleriResource::collection($galeri);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $galeri = Galeri::find($id);

        if (!$galeri) {
            return response()->json(['message' => 'data not found'], 404);
        }

        return new GaleriResource($galeri);
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
