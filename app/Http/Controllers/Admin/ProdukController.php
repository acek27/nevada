<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\Datatables\Datatables;
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

    public function listProduk(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $produk = produk::select('id_produk', 'nama_kategori', 'nama_produk', 'harga', 'stok', 'deskripsi', 'size', 'warna')
                ->join('size', 'size.id_size', '=', 'produk.id_size')
                ->join('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
                ->join('warna', 'warna.id_warna', '=', 'produk.id_warna')
                ->get();
            return DataTables::of($produk)
                ->addColumn('action', function ($produk) {
                    $edit = "<a href=\"" . route('produk.edit', $produk->id_produk) . "\">
                            <i class=\"material-icons\" title=\"Edit\" style=\"color: cadetblue\">edit</i></a>";
                    $delete = "<a href=\"/admin/produk/$produk->id_produk/delete\">
                            <i class=\"material-icons\" title=\"Delete\" style=\"color: cadetblue\">delete</i></a>";
                    return $edit.$delete;
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'id_produk', 'name' => 'id_produk', 'title' => 'ID'])
            ->addColumn(['data' => 'nama_produk', 'name' => 'nama_produk', 'title' => 'Nama Produk'])
            ->addColumn(['data' => 'nama_kategori', 'name' => 'nama_kategori', 'title' => 'Kategori'])
            ->addColumn(['data' => 'harga', 'name' => 'harga', 'title' => 'Harga'])
            ->addColumn(['data' => 'deskripsi', 'name' => 'deskripsi', 'title' => 'Deskripsi'])
            ->addColumn(['data' => 'stok', 'name' => 'stok', 'title' => 'Stok Barang'])
            ->addColumn(['data' => 'size', 'name' => 'size', 'title' => 'Ukuran'])
            ->addColumn(['data' => 'warna', 'name' => 'warna', 'title' => 'Warna'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);
        return view('admin.lproduk', compact('html'));
    }

    public function emProduk(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $produk = produk::select('id_produk', 'nama_kategori', 'nama_produk', 'harga', 'stok', 'deskripsi', 'size', 'warna')
                ->join('size', 'size.id_size', '=', 'produk.id_size')
                ->join('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
                ->join('warna', 'warna.id_warna', '=', 'produk.id_warna')
                ->where('stok', '=', '0')
                ->get();
            return DataTables::of($produk)
                ->addColumn('action', function ($produk) {
                    $edit = "<a data-id=\"" . $produk->id_produk . "\" value=\"\" href = \"#\" class='editmodal'>
                            <i class=\"material-icons\" title=\"Edit\" style=\"color: cadetblue\">edit</i></a>";
                    $delete = "<a href=\"/admin/produk/$produk->id_produk/delete\">
                            <i class=\"material-icons\" title=\"Delete\" style=\"color: cadetblue\">delete</i></a>";
                    return $edit . $delete;
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'id_produk', 'name' => 'id_produk', 'title' => 'ID'])
            ->addColumn(['data' => 'nama_produk', 'name' => 'nama_produk', 'title' => 'Nama Produk'])
            ->addColumn(['data' => 'nama_kategori', 'name' => 'nama_kategori', 'title' => 'Kategori'])
            ->addColumn(['data' => 'harga', 'name' => 'harga', 'title' => 'Harga'])
            ->addColumn(['data' => 'deskripsi', 'name' => 'deskripsi', 'title' => 'Deskripsi'])
            ->addColumn(['data' => 'stok', 'name' => 'stok', 'title' => 'Stok Barang'])
            ->addColumn(['data' => 'size', 'name' => 'size', 'title' => 'Ukuran'])
            ->addColumn(['data' => 'warna', 'name' => 'warna', 'title' => 'Warna'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);
        return view('admin.phabis', compact('html'));
    }

    public function editStok(Request $request, $id)
    {
        $request->validate([
            'stok' => 'numeric'
        ]);
        $produk = produk::findOrFail($id);
        $produk->stok = $request->get('stok');
        $produk->update();
        return $produk;
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
        $request->validate([
           'pdharga' => 'numeric',
           'stok' => 'numeric'
        ]);
        $nama = $request->get('pdname');
        $harga = $request->get('pdharga');
        $desc = $request->get('pddeskrip');
        $size = $request->get('size');
        $warna = $request->get('warna');
        $kategori = $request->get('kategori');
        $cek = \DB::table('produk')->select('*')->where('nama_produk', '=', $nama)->where('harga', '=', $harga)->where('deskripsi', '=', $desc)->where('id_size','=', $size)->where('id_warna', '=', $warna)->where('id_kategori', '=', $kategori);
        if ($cek->exists()) {
            \Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Produk sudah ada."
            ]);
            return redirect('/admin/listProduk');
        } else {
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
        return redirect('/admin/listProduk');

        \Session::flash("flash_notification", [
            "level" => "succes",
            "message" => "Berhasil menambahkan produk $request->pdname"
        ]);
        return redirect ('/admin/listProduk');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $request->validate([
            'stok' => 'numeric',
            'pdharga' => 'numeric'
        ]);
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
        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Update Produk $request->pdname Berhasil"
        ]);
        return redirect('/admin/listProduk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id){
        $produk = produk::find($id);
        $produk->delete();
        \Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Produk $produk->nama_produk Berhasil Dihapus"
        ]);
        return redirect('/admin/listProduk');
    }

    public function destroy($id)
    {
        //
    }
}
