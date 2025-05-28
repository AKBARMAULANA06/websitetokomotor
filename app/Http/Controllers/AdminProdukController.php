<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS1D;

class AdminProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->paginate(10);
        
        $data = [
            'title' => 'Manajemen Produk',
            'produk' => $produk,
            'content' => 'admin/produk/index'
        ];
        
        return view('admin.layouts.wrapper', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Produk',
            'kategori' => Kategori::all(),
            'content' => 'admin/produk/create'
        ];
        
        return view('admin.layouts.wrapper', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $file_name = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('uploads/images', $file_name, 'public');
            $validatedData['gambar'] = $path;
        }

        Produk::create($validatedData);

        Alert::success('Sukses', 'Produk berhasil ditambahkan');
        return redirect()->route('produk.index');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        
        $data = [
            'title' => 'Edit Produk',
            'produk' => $produk,
            'kategori' => Kategori::all(),
            'content' => 'admin/produk/create'
        ];
        
        return view('admin.layouts.wrapper', $data);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }

            // Store new image
            $gambar = $request->file('gambar');
            $file_name = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('uploads/images', $file_name, 'public');
            $validatedData['gambar'] = $path;
        } else {
            $validatedData['gambar'] = $produk->gambar;
        }

        $produk->update($validatedData);

        Alert::success('Sukses', 'Produk berhasil diperbarui');
        return redirect()->route('produk.index');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Delete associated image
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        Alert::success('Sukses', 'Produk berhasil dihapus');
        return redirect()->route('produk.index');
    }
}