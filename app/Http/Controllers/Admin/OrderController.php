<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Model\orderUser;
use App\Model\pembayaran;

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
            $order = orderUser::select('id_order', 'no_order', 'nama_penerima', 'tgl_pesanan', 'alamat', 'status', 'no_hp', 'total', 'resi', 'nama', 'nama_produk')
                ->join('ekspedisi', 'ekspedisi.id_ekspedisi', '=', 'order.id_ekspedisi')
                ->join('produk', 'produk.id_produk', '=', 'order.id_produk')
                ->where('status', '<', '6');
            return DataTables::of($order)
                ->addColumn('action', function ($order) {
                    $detail = "<a href=\"" . route('Order.detail', $order->id_order) . "\"  style='float: right' title='Detail Pesanan'><i class='material-icons'>open_in_new</i></a>";
                    if ($order->status == 2) {
                        $waiting = "<a disabled='disabled'  title='Menunggu Konfirmasi Pembayaran'>Menunggu...</a>";
                        $batal = "<a href=\"" . route('Order.batal', $order->id_order) . "\"><i class=\"material-icons\" title=\"Batalkan Pesanan\" style=\"color: red\">close</i></a>";
                        return $waiting . $batal . $detail;
                    } elseif ($order->status == 3) {
                        $lihat = "<a href=\"" . route('OrderProses.show', $order->id_order) . "\"><i class=\"material-icons\" title=\"Detail Pembayaran\">library_books</i></a>";
                        return $lihat . $detail;
                    } elseif ($order->status == 4) {
                        $kirim = "<a data-id=\"" . $order->id_order . "\" value=\"\" href=\"#\" class='editmodal'><i class=\"material-icons\" title=\"Kirim Sekarang\">local_shipping</i></a>";
                        return $kirim . $detail;
                    } elseif ($order->status == 5) {
                        $send = "<a disabled='disabled' title='Dalam Pengiriman'>Menunggu Diterima</a>";
                        return $send . $detail;
                    } elseif ($order->status == 6) {
                        $received = "<a disabled='disabled' title='Pesanan Telah Diterima'>Pesanan Diterima</a>";
                        return $received . $detail;
                    } elseif ($order->status == 7) {
                        $cancel = "<a disabled='disabled' title='Pesanan Dibatalkan'>Pesanan Dibatalkan</a>";
                        return $cancel . $detail;
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
        return view('admin.order', compact('html'));
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
        $order = orderUser::findOrFail($id);
        $verify = pembayaran::where('id_order', $id)->first();
        return view('admin.dbayar', compact('order', 'verify'));
    }

    public function verify($id)
    {
        orderUser::findOrFail($id)->update(['status' => 4]);
        return redirect('/admin/OrderProses');
    }

    public function batal($id)
    {
        orderUser::findOrFail($id)->update(['status' => 7]);
        return redirect('/admin/OrderProses');
    }

    public function detail($id)
    {
        $order = orderUser::findOFail($id);
        return view('admin.dpesanan', compact('order'));
    }

    public function addresi(Request $request, $id)
    {
        $order = orderUser::findOrFail($id);
        $order->resi = $request->get('resi');
        $order->status = 5;
        $order->tgl_kirim = date(Y-m-d);
        $order->update();
        return $order;
    }

    public function addresi_view(Request $request, $id)
    {
        $order = orderUser::findOrFail($id);
        $order->resi = $request->get('resi');
        $order->status = 5;
        $order->tgl_kirim = date('Y-m-d');
        $order->update();
        return redirect ('/admin/OrderProses');
    }

    public function selesai(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $order = orderUser::select('no_order', 'nama_penerima', 'tgl_pesanan', 'alamat', 'tgl_diterima')
                ->where('status', '=', '6');
            return DataTables::of($order)
                ->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'no_order', 'name' => 'no_order', 'title' => 'No. Order'])
            ->addColumn(['data' => 'tgl_pesanan', 'name' => 'tgl_pesanan', 'title' => 'Tanggal Pemesanan'])
            ->addColumn(['data' => 'nama_penerima', 'name' => 'nama_penerima', 'title' => 'Nama Penerima'])
            ->addColumn(['data' => 'alamat', 'name' => 'alamat', 'title' => 'Alamat Penerima'])
            ->addColumn(['data' => 'tgl_diterima', 'name' => 'tgl_diterima', 'title' => 'Tanggal Diterima']);
        $status = 6;
        return view('admin.history', compact('html', 'status'));
    }

    public function Obatal(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $order = orderUser::select('no_order', 'nama_penerima', 'tgl_pesanan', 'alamat')
                ->where('status', '=', '7');
            return Datatables::of($order)
                ->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'no_order', 'name' => 'no_order', 'title' => 'No. Order'])
            ->addColumn(['data' => 'tgl_pesanan', 'name' => 'tgl_pesanan', 'title' => 'Tanggal Pesanan'])
            ->addColumn(['data' => 'nama_penerima', 'name' => 'nama_penerima', 'title' => 'Nama Penerima'])
            ->addColumn(['data' => 'alamat', 'name' => 'alamat', 'title' => 'Alamat']);
        $status = 7;
        return view('admin.history', compact('html', 'status'));
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
