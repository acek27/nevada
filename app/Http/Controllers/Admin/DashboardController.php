<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\produk;
use Yajra\DataTables\Html\Builder;
use Yajra\Datatables\Datatables;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $produk = produk::select('id_produk','nama_kategori','nama_produk','harga','stok','deskripsi','size','warna')
                ->join('size', 'size.id_size','=','produk.id_size')
                ->join('kategori', 'kategori.id_kategori','=','produk.id_kategori')
                ->join('warna', 'warna.id_warna','=','produk.id_warna')
                ->get();
            return DataTables::of($produk)
                ->addColumn('action', function ($produk) {
                    $edit = "<a style=\"margin-left:20px\" href=\"" . route('produk.edit', $produk->id_produk) . "\"><i class=\"material-icons\">edit</i></a>";
                    return $edit;
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
        return view('admin.dashboard', compact('html'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
