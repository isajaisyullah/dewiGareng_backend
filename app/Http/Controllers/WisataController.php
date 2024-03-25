<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // in PaketController;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        return view('page.kategori_wisata.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'name' => 'required',
            'users_id' => 'required|exists:users,id',
        ]);

        Wisata::create($validated);

        return redirect()->route('wisata.index')->with([
            'message' => "Berhasil dibuat!",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $wisata = Wisata::where('wisata.id', '=', $id)->first();

        return view('page.kategori_wisata.show', compact('wisata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = auth()->user();
        $wisata = Wisata::findOrFail($id);

        return view('page.kategori_wisata.edit', compact(['wisata', 'user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $wisata = Wisata::findOrFail($id);

        $validated= $request->validate([
            'name' => 'required',
            'users_id' => 'required|exists:users,id',
        ]);

        $wisata->update($validated);

        return redirect()->route('wisata.index')->with([
            'message' => "Berhasil diUbah!",
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wisata = Wisata::findOrFail($id);

        $wisata->delete();

        return redirect()->route('wisata.index')->with([
            'message' => 'Berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}
