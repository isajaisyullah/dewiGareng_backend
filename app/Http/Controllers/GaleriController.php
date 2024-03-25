<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchData = $request->input('search');

        $query = Galeri::query();

        if($searchData){
            $query->where('title', 'like', '%' . $searchData . '%');
        }

        $galeri = $query->latest()->paginate(10);

        return view('page.galeri.index', compact('galeri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        return view('page.galeri.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Assuming logo is an image
            'users_id' => 'required|exists:users,id', // Assuming the id_user must exist in the super_admins table
        ]);

        // Handle file upload
        if ($request->hasFile('picture')) {
            $fileName = time() . '_galeri_' . $request->file('picture')->getClientOriginalName();
            $path = $request->file('picture')->storeAs('pictures', $fileName, 'public');
            $validated['picture'] = '/storage/'.$path;
        }

        $galeri = Galeri::create($validated);

        return redirect()->route('galeri.index')->with([
            'message' => "Berhasil dibuat!",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $galeri = Galeri::with('user') ->where('galeri.id', '=', $id)->first();

        return view('page.galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = auth()->user();
        $galeri = Galeri::findOrFail($id);

        return view('page.galeri.edit', compact(['galeri', 'user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validated= $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Assuming logo is an image
            'users_id' => 'required|exists:users,id', // Assuming the id_user must exist in the super_admins table
        ]);

        // Handle file upload
        if ($request->hasFile('picture')) {
            // Delete the existing file
            $this->deleteFile($galeri->picture);

            $fileName = time() . '_galeri_' . $request->file('picture')->getClientOriginalName();
            $path = $request->file('picture')->storeAs('pictures', $fileName, 'public');
            $validated['picture'] = '/storage/'.$path;
        }

        // Update the Toko record with the validated data
        $galeri->update($validated);

        return redirect()->route('galeri.index')->with([
            'message' => "Berhasil diUbah!",
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        $this->deleteFile($galeri->picture);

        $galeri->delete();

        return redirect()->route('galeri.index')->with([
            'message' => 'Berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}
