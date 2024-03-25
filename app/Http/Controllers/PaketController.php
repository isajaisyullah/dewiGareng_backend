<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchData = $request->input('searchWisata');
        $searchPaket = $request->input('searchPaket');

        //Handle Wisata
        $queryWisata = Wisata::query();

        if($searchData){
            $queryWisata->where('name', 'like', '%' . $searchData . '%');
        }

        $wisata =$queryWisata->latest()->paginate(3, ['*'], 'wisata_page');


        //Handle Paket_Wisata
        $queryPaket = Paket::query()->with('wisata');

        if ($searchPaket) {
            $queryPaket->where(function ($queryPaket) use ($searchPaket) {
                $queryPaket->where('paket_wisata.name', 'like', '%' . $searchPaket . '%')
                    ->orWhereHas('wisata', function ($query) use ($searchPaket) {
                        $query->where('name', 'like', '%' . $searchPaket . '%');
                    });
            });
        }

        $paket = $queryPaket->latest()->paginate(5, ['*'], 'paket_page');

        return view('page.wisata.index', compact(['paket', 'wisata'])); //add wisata table
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //get table wisata data
        $wisata = Wisata::all();
        return view('page.wisata.create', compact('wisata'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'wisata_ids' => 'required|array|exists:wisata,id',
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $fileName = time() . '_wisata_' . $request->file('picture')->getClientOriginalName();
            $path = $request->file('picture')->storeAs('pictures', $fileName, 'public');
            $validated['picture'] = '/storage/'.$path;
        }

        $paket = Paket::create($validated);

        // Attach the selected Wisata to the Paket
        $paket->wisata()->attach($validated['wisata_ids']);

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
        $paket = Paket::with('wisata')->where('paket_wisata.id', '=', $id)->first();

        return view('page.wisata.show', compact(['paket']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paket = Paket::findOrFail($id);

        $wisata = Wisata::all();

        return view('page.wisata.edit', compact(['paket', 'wisata']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        // dd($paket);
        $validated= $request->validate([
            'wisata_ids' => 'required|array|exists:wisata,id',
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $this->deleteFile($paket->picture);

            $fileName = time() . '_wisata_' . $request->file('picture')->getClientOriginalName();
            $path = $request->file('picture')->storeAs('pictures', $fileName, 'public');
            $validated['picture'] = '/storage/'.$path;
        }

        $paket->update($validated);

        // Sync the selected Wisata to the Paket
        $paket->wisata()->sync($validated['wisata_ids']);

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
        $paket = Paket::findOrFail($id);

        $this->deleteFile($paket->picture);

        $paket->delete();

        return redirect()->route('wisata.index')->with([
            'message' => 'Berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}
