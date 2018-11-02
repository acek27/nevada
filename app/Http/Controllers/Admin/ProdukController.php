<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\produk;
use App\Model\warna;
use App\Model\kategori;
use App\Model\size;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = produk::all();
        $warna = warna::all();
        $size = size::all();
        $kategori = kategori::all();
        return view('admin.cproduk', compact('produk', 'warna', 'size', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path("images"), $new_name);
        $produk = new produk();
        $produk->nama_produk = $request->get('pdname');
        $produk->harga = $request->get('pdharga');
        $produk->deskripsi = $request->get('pddeskrip');
        $produk->image = $new_name;
        $produk->stok = $request->get('stok');
        $produk->id_size = $request->get('size');
        $produk->id_warna = $request->get('warna');
        $produk->id_kategori = $request->get('kategori');
        $produk->save();
        return redirect('/dashboardAdmin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = produk::findOrFail($id);
        return view('user.dproduk')->with(compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = produk::findOrFail($id);
        $warna = warna::all();
        $size = size::all();
        $kategori = kategori::all();
        return view('admin.eproduk')->with(compact('produk', 'warna', 'size', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = produk::findOrFail($id);
        $image = $request->file('image');
        $produk->nama_produk = $request->get('pdname');
        $produk->harga = $request->get('pdharga');
        $produk->deskripsi = $request->get('pddeskrip');
        if ($image == '') {
            unset($produk['image']);
        } else {
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("images"), $new_name);
            $produk->image = $new_name;
        }
        $produk->stok= $request->get('stok');
        $produk->id_size = $request->get('size');
        $produk->id_warna = $request->get('warna');
        $produk->id_kategori = $request->get('kategori');
        $produk->update();
        return redirect('/dashboardAdmin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
