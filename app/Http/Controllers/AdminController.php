<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user->nama = $user->name; // Rename 'name' to 'nama'

        $users = User::all();

        return view('page.profile.index', compact(['user', 'users']));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $store = Umkm::where('users_id', $id)->paginate(5);

        return view('page.profile.show', compact(['user', 'store']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('page.profile.edit', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated= $request->validate([
            'name' => 'required|string',
            'phone' => 'numeric|digits_between:8,13|required',
        ]);

        $user->update($validated);

        return redirect()->route('dashboard.index')->with([
            'message' => "Berhasil diUbah!",
            'alert-type' => 'info'
        ]);
    }
}
