<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\produk;
use App\Model\orderUser;
use App\Model\ekspedisi;
use Yajra\DataTables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $order = orderUser::select('id_order','nama_penerima','tgl_pesanan','alamat','no_hp','total','produk.nama_produk as produk','ekspedisi.nama as ekspedisi')
                ->join('produk', 'produk.id_produk', '=', 'order.id_produk')
                ->join('ekspedisi', 'ekspedisi.id_ekspedisi', '=', 'order.id_ekspedisi')
                ->where('id_user', Auth::user()->id);
            return DataTables::of($order)
                ->addColumn('action', function ($order) {
                    $konfirmasi = "<a href=\"" . route('produk.edit', $order->id_order) . "\">Konfirmasi Pembayaran</a>";
                    return $konfirmasi;
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'id_order', 'name' => 'id_order', 'title' => 'ID'])
            ->addColumn(['data' => 'nama_penerima', 'name' => 'nama_penerima', 'title' => 'Nama Penerima'])
            ->addColumn(['data' => 'no_hp', 'name' => 'no_hp', 'title' => 'No HP'])
            ->addColumn(['data' => 'tgl_pesanan', 'name' => 'tgl_pesanan', 'title' => 'Tanggal Pemesanan'])
            ->addColumn(['data' => 'alamat', 'name' => 'alamat', 'title' => 'Alamat'])
            ->addColumn(['data' => 'produk', 'name' => 'produk', 'title' => 'Produk'])
            ->addColumn(['data' => 'ekspedisi', 'name' => 'ekspedisi', 'title' => 'Eskpedisi'])
            ->addColumn(['data' => 'total', 'name' => 'total', 'title' => 'Total'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);

        return view('user.pesanan', compact('html'));
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
        //
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
        $user = Auth::user()->name;
        $ekspedisi = ekspedisi::all();

        return view('user.coutproduk')->with(compact('produk', 'user', 'ekspedisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $idUser = Auth::user()->id;
        $order = new orderUser();
        $order->nama_penerima = $request->get('nama');
        $order->tgl_pesanan = date('Y-m-d');
        $order->alamat = $request->get('almt');
        $order->no_hp = $request->get('nohp');
        $order->status = 2;
        $order->id_produk = $id;
        $order->id_user = $idUser;
        $order->id_ekspedisi = $request->get('eks');
        $order->total = $request->get('tot');
        $order->save();

        $stok = produk::where('id_produk', $id)->first()->stok;
        produk::where('id_produk', $id)->update(['stok' => $stok - 1]);
        return redirect('/OrderReq');
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
