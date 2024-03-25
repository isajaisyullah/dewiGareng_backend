<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User;
use App\Models\Galeri;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $adminUser = Auth::user();

            $users = User::paginate(5, ['*'], 'user_page');

            $allUsers = User::pluck('id');
            $allStores = Umkm::pluck('id');
            $allProducts = Product::pluck('id');
            $allGaleri = Galeri::pluck('id');

            $id = $adminUser->id;
            $storeUser = Umkm::where('users_id', $id)->get();
            $productUser = $adminUser->umkmProducts->pluck('id');

            // Pass user data to the dashboard view
            return view('page.dashboard', compact(['adminUser', 'users', 'allUsers', 'allStores', 'allProducts', 'allGaleri', 'storeUser', 'productUser']));
    }
}
