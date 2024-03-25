<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserUmkmController extends Controller
{
    public function index(Request $request)
    {
        $searchData = $request->input('search');

        // dd(auth()->user());
        $user = auth()->user();

        $query = Umkm::query()->where('users_id', $user->id);

        if($searchData){
            $query->where('name', 'like', '%' . $searchData . '%');
        }

        $store = $query->latest()->paginate(10);

        return view('page.store.index', compact(['store']));
    }


    public function show($id)
    {
        // Find Umkm by ID

        $query = Umkm::query()->with([
            'user' => function ($data) {
                $data->select('id', 'name', 'email', 'phone');
            }
        ])->where('umkm.id', '=', $id);

        $store = $query->findOrFail($id);

        return view('page.store.show', compact('store'));
    }

    public function create(){
        $user = auth()->user();
        // $users = User::where('name', $user)->get();
        return view('page.store.create', compact('user'));
    }

    public function store(Request $request){
        $validated= $request->validate([
            'name' => 'required|string|max:255|unique:umkm,name',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Assuming logo is an image
            'users_id' => 'required|exists:users,id', // Assuming the id_user must exist in the super_admins table
        ]);

        // Handle file upload if a logo is provided
        if ($request->hasFile('logo')) {
            $fileName = time() . '_umkm_' . $request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->storeAs('logos', $fileName, 'public');
            $validated['logo'] = '/storage/'.$path;
        }

        $store = Umkm::create($validated);

        return redirect()->route('storeUser.index')->with([
            'message' => "Berhasil dibuat!",
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        // Find Umkm by ID
        $store = Umkm::findOrFail($id);

        $user = auth()->user();

        // Return view for editing the Umkm
        return view('page.store.edit', compact(['store', 'user']));
    }

    public function update(Request $request, $id)
    {
        // Find Toko by ID
        $store = Umkm::findOrFail($id);

        // Validate the incoming request data
        $validated= $request->validate([
            'name' => 'required|string|max:255|unique:umkm,name,' . $store->id,
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Assuming logo is an image
            'users_id' => 'required|exists:users,id', // Assuming the id_user must exist in the super_admins table
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
        return redirect()->route('storeUser.index')->with([
            'message' => "Berhasil diUbah!",
            'alert-type' => 'info'
        ]);

    }


    public function destroy($id){
        // Find Toko by ID
        $store = Umkm::findOrFail($id);

        $this->deleteFile($store->logo);

        $store->delete();

        return redirect()->route('storeUser.index')->with([
            'message' => 'Berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}
