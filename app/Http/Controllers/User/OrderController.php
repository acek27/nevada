<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Model\produk;
use App\Model\orderUser;
use App\Model\ekspedisi;
use App\Model\pembayaran;
use Yajra\DataTables\Html\Builder;
use Yajra\Datatables\Datatables;


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
            $order = orderUser::select('id_order', 'no_order', 'nama_penerima', 'tgl_pesanan', 'alamat', 'status', 'no_hp', 'total', 'nama', 'nama_produk')
                ->join('ekspedisi', 'ekspedisi.id_ekspedisi', '=', 'order.id_ekspedisi')
                ->join('produk', 'produk.id_produk', '=', 'order.id_produk')
                ->where('id_user', Auth::user()->id)
                ->where('status', '<', '6');
            return DataTables::of($order)
                ->addColumn('action', function ($order) {
                    $detail = "<a href=\"" . route('OrderReq.detail', $order->id_order) . "\"  style='float: right' title='Detail Pesanan'><i class='material-icons'>open_in_new</i></a>";
                    if ($order->status == 2) {
                        $edit = "<a href=\"" . route('OrderReq.edit', $order->id_order) . "\">Konfirmasi Pembayaran</a>";
                        return $edit . $detail;
                    } elseif ($order->status == 3) {
                        $edit = "<a disabled='disabled'>Menunggu Verifikasi</a>";
                        return $edit . $detail;
                    } elseif ($order->status == 4) {
                        $edit = "<a disabled='disabled' style='font-size: 13px'>Menunggu Pengiriman</a>";
                        return $edit . $detail;
                    } elseif ($order->status == 5) {
                        $kirim = "<a disabled='disabled'>Dalam Pengiriman</a>";
                        return $kirim . $detail;
                    }
                })
                ->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'no_order', 'name' => 'no_order', 'title' => 'No. Order'])
            ->addColumn(['data' => 'tgl_pesanan', 'name' => 'tgl_pesanan', 'title' => 'Tanggal Pemesanan'])
            ->addColumn(['data' => 'nama_penerima', 'name' => 'nama_penerima', 'title' => 'Nama Penerima'])
            ->addColumn(['data' => 'total', 'name' => 'total', 'title' => 'Total Pembelian'])
            ->addColumn(['data' => 'nama_produk', 'name' => 'nama_produk', 'title' => 'Produk'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);

        return view('user.pesanan', compact('html'));
    }

    public function history ()
    {
        $done = orderUser::select('id_order', 'no_order', 'nama_penerima', 'tgl_pesanan', 'alamat', 'status', 'no_hp', 'total', 'nama', 'nama_produk', 'tgl_diterima')
            ->join('ekspedisi', 'ekspedisi.id_ekspedisi', '=', 'order.id_ekspedisi')
            ->join('produk', 'produk.id_produk', '=', 'order.id_produk')
            ->where('status', '>=', '6')
            ->orderBy('tgl_pesanan','desc')
            ->get();
        return view('user.history', compact('done'));
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
        $order = orderUser::all();

        return view('user.coutproduk')->with(compact('produk', 'user', 'ekspedisi','order'));
    }

    public function detail($id)
    {
        $order = orderUser::findOrFail($id);
        return view('user.dpesanan', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = orderUser::findOrFail($id);
        return view('user.confirm', compact('order'));
    }

    public function received($id)
    {
        orderUser::where('id_order', $id)->update ([
            'status' => 6,
            'tgl_diterima' => date('Y-m-d')
        ]);
        return redirect('/user/OrderReq');
    }

    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'rek' => 'numeric',
        ]);
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path("images"), $new_name);
        $konfirm = new pembayaran();
        $konfirm->nama_bank = $request->get('bank');
        $konfirm->no_rek = $request->get('rek');
        $konfirm->a_n = $request->get('an');
        $konfirm->tgl_bayar = date('Y-m-d');
        $konfirm->bukti_bayar = $new_name;
        $konfirm->id_order = $id;
        $konfirm->save();

        orderUser::where('id_order', $id)->update(['status' => 3]);
        return redirect('/user/OrderReq');
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
            'nohp' => 'numeric',
        ]);
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
        return redirect('/user/OrderReq');
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
