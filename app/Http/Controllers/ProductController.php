<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(3);

        return view('products.index', compact('products'));
    }

    public function create() 
    {
        return view('products.create');
    }

    public function store(Request $request)
{
    $this->validate($request, [
        'nama' => 'required',
        'harga' => 'required|numeric',
        'foto' => 'required|image|mimes:jpeg,png,jpg'
    ]);

    $foto = $request->file('foto');
    
    // Simpan gambar ke folder public/assets/images
    $foto->move(public_path('assets/images'), $foto->getClientOriginalName());

    Product::create([
        'nama' => $request->nama,
        'harga' => $request->harga,
        'deskripsi' => $request->deskripsi,
        // Simpan nama file gambar
        'foto' => $foto->getClientOriginalName()
    ]);
    
    return redirect()->route('products.index')->with('success', 'Add Product Success');
}
    public function edit(Product $product)
    {
        return view('products.edit', compact ('product'));
    }
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required|numeric',
        ]);

        $product->nama = $request->nama;
        $product->harga = $request->harga;
        $product->deskripsi = $request->deskripsi;

        if ($request->file('foto')) 
        {
            Storage::disk('local')->delete('public/', $product->foto);
            $foto = $request->file('foto');
            $foto->move(public_path('assets/images'), $foto->getClientOriginalName());
            $product->foto = $foto->getClientOriginalName();
        }
        $product->update();
        return redirect()->route('products.index')->with('success', 'Update Product Success');
    }

    public function destroy(Product $product)
    {
        if ($product->foto != "noimage.png") {
            Storage::disk('local')->delete('public/', $product->foto);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Delete Product Success');
    }
}
