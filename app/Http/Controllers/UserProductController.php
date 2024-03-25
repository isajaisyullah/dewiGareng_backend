<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchData = $request->input('search');

        $user = auth()->user();

        $umkm= Umkm::where('users_id', $user->id)->first(); //page umkm not empty

        if ($umkm != null){
            $query = Product::query()->with('category')->where('umkm_id', $umkm->id);

            if($searchData){
                $query->where('name', 'like', '%' . $searchData . '%');
            }

            $products = $query->latest()->paginate(10);
            return view('page.product.index', compact(['products', 'umkm']));
        }

        return view('page.product.index', compact(['umkm']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        $umkm= Umkm::where('users_id', $user->id)->first();
        $categories = Category::all();

        return view('page.product.create', compact(['umkm', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:category,id',
            'umkm_id' => 'required|exists:umkm,id',
        ]);

        if ($request->hasFile('picture')) {
            $fileName = time() . '_product_' . $request->file('picture')->getClientOriginalName();
            $path = $request->file('picture')->storeAs('pictures', $fileName, 'public');
            $validated['picture'] = '/storage/'.$path;
        }

        $product= Product::create($validated);

        return redirect()->route('productUser.index')->with([
            'message' => "Berhasil dibuat!",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::join('umkm', 'product.umkm_id', '=', 'umkm.id')
        ->where('product.id', '=', $id)
        ->join('users', 'umkm.users_id', '=', 'users.id')
        ->select(
        'product.*', 'product.name as namaProduct', 'product.description as deskripsiProduk', 'product.picture as fotoProduk',
        'umkm.address', 'umkm.name as namaUMKM', 'umkm.description as deskripsiUMKM', 'umkm.logo',
        'users.name as pemilik', 'users.email', 'users.phone'
        )->first();

        $category = Category::find($product->category_id);

        return view('page.product.show', compact(['product', 'category']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();

        $umkm= Umkm::where('users_id', $user->id)->first();
        $categories = Category::all();

        return view('page.product.edit', compact(['product', 'umkm', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated= $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:category,id',
            'umkm_id' => 'required|exists:umkm,id',
        ]);

        if ($request->hasFile('picture')) {
            // Delete the existing file
            $this->deleteFile($product->picture);

            $fileName = time() . '_product_' . $request->file('picture')->getClientOriginalName();
            $path = $request->file('picture')->storeAs('pictures', $fileName, 'public');
            $validated['picture'] = '/storage/'.$path;
        }

        $product->update($validated);

        // Redirect to the show route for the updated Toko
        return redirect()->route('productUser.index')->with([
            'message' => "Berhasil diUbah!",
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $this->deleteFile($product->picture);

        $product->delete();

        return redirect()->route('productUser.index')->with([
            'message' => 'Berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}
