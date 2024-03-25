<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchData = $request->input('search');

        $query = Umkm::query()->with([
            'user' => function ($data) {
                $data->select('id', 'name');
            }
        ]);

        // if($searchData){
        //     $query->where('name', 'like', '%' . $name . '%');
        // }

        if ($searchData) {
            $query->where(function ($query) use ($searchData) {
                $query->where('umkm.name', 'like', '%' . $searchData . '%')
                    ->orWhereHas('user', function ($userQuery) use ($searchData) {
                        $userQuery->where('name', 'like', '%' . $searchData . '%');
                    });
            });
        }

        $store = $query->latest()->paginate(10);
        return view('page.store.index', compact('store'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('id', 'name')->get();
        return view('page.store.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:umkm,name',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'users_id' => 'required|exists:users,id',
        ]);

        // Handle file upload if a logo is provided
        if ($request->hasFile('logo')) {
            $fileName = time() . '_umkm_' . $request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->storeAs('logos', $fileName, 'public');
            $validated['logo'] = '/storage/'.$path;
        }

        $store = Umkm::create($validated);

        return redirect()->route('store.index')->with([
            'message' => "Berhasil dibuat!",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $store = UMKM::leftjoin('users', 'umkm.users_id', '=', 'users.id')
        // ->where('umkm.id', '=', $id)
        // ->select('umkm.*', 'users.name as pemilik', 'users.email', 'users.phone')
        // ->first();

        $query = Umkm::query()->with([
            'user' => function ($data) {
                $data->select('id', 'name', 'email', 'phone');
            }
        ])->where('umkm.id', '=', $id);

        $store = $query->first();

        return view('page.store.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find Toko by ID
        $store = Umkm::findOrFail($id);

        $users = User::select('id', 'name')->get();

        // Return view for editing the Toko
        return view('page.store.edit', compact(['store','users']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find Toko by ID
        $store = Umkm::findOrFail($id);

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:umkm,name,' . $store->id,
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'users_id' => 'required|exists:users,id',
        ]);

         // Update the Toko record with the validated data
         if ($request->hasFile('logo')) {
            // Delete the existing file
            $this->deleteFile($store->logo);

            $fileName = time() . '_umkm_' . $request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->storeAs('logos', $fileName, 'public');
            $validated['logo'] = '/storage/'.$path;
        }

        // Update the Toko record with the validated data
        $store->update($validated);

        // Redirect to the show route for the updated Toko
        return redirect()->route('store.index')->with([
            'message' => "Berhasil diUbah!",
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find Toko by ID
        $store = Umkm::findOrFail($id);

        $this->deleteFile($store->logo);

        $store->delete();

        return redirect()->route('store.index')->with([
            'message' => 'Berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}
