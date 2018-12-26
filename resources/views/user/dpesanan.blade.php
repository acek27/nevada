@extends('master.layout')

@section('title')
    Detail Order
@endsection

@section('subtitle')
    Detail Order
@endsection

@section('content')
    <div class="col-lg-11">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title"><strong>Detail Order</strong> INFO</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="/images/{{$order->produk->image}}" width="100%" max-width="450px" height="550px"
                             style="height: auto">
                    </div>
                    <div class="col-lg-6">
                        <br>
                        <div class="table-responsive">
                            {!! Form::model($order,['url'=>route('Order.addresi_view',$order->id_order),'method'=>'put']) !!}
                            {{ csrf_field() }}
                            <table class="table">
                                <h4 style="font-size: 25px"><strong>{{$order->produk->nama_produk}} - NEVADA</strong>
                                </h4>
                                <thead>
                                <tr>
                                    <th>
                                        <strong>Size</strong>
                                    </th>
                                    <td>
                                        <div> {{$order->produk->size->size}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Warna</strong>
                                    </th>
                                    <td>
                                        <div> {{$order->produk->warna->warna}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Deskripsi</strong>
                                    </th>
                                    <td>
                                        <div> {{$order->produk->deskripsi}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Tanggal Order</strong>
                                    </th>
                                    <td>
                                        <div> {{$order->tgl_pesanan}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Nama Penerima</strong>
                                    </th>
                                    <td>
                                        <div> {{$order->nama_penerima}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Alamat Penerima</strong>
                                    </th>
                                    <td>
                                        <div> {{$order->alamat}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>No. Hp</strong>
                                    </th>
                                    <td>
                                        <div> {{$order->no_hp}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Ekspedisi</strong>
                                    </th>
                                    <td>
                                        <div> {{$order->ekspedisi->nama}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>No. Resi</strong>

                                    </th>
                                    <td>
                                        @if($order->status == 4)
                                            <input type="text" name="resi" class="form-control"required>
                                        @else
                                            <div> {{$order->resi}} </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Total</strong>
                                    </th>
                                    <td>
                                        <div style="margin-right:100px;font-size: 25px; color:yellowgreen">
                                            <strong>Rp{{number_format($order->total,2,',','.')}}</strong></div>
                                    </td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer">
                            @can('admin')
                                @if($order->status == 4)
                                    <div class="stats">
                                        <a href="{{route('Order.batal',$order->id_order)}}" class="btn btn-danger"
                                           style="margin: 14px 0px 15px -12px"><span><i
                                                    title="Batalkan Order" class="material-icons"
                                                    style="position: initial">close</i>Batalkan Order</span></a>
                                    </div>
                                    <div class="stats">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="material-icons" style="position: initial">update</i> Update Resi
                                        </button>
                                    </div>
                                @else
                                    <div class="stats">
                                        <a href="{{route('OrderProses.index')}}" class="btn btn-danger"
                                           style="margin: 0px 0px 15px -12px"><span><i
                                                    title="Batalkan Order" class="material-icons"
                                                    style="position: initial">close</i>Kembali</span></a>
                                    </div>
                                @endif
                            @endcan
                            @can('user')
                                @if($order->status == 2)
                                    <div class="stats">
                                        <a href="{{route('OrderReq.edit', $order->id_order)}}" class="btn btn-primary"
                                           style="margin: 0px 0px 15px -12px"><span><i
                                                    title="Konfirmasi Pembayaran" class="material-icons"
                                                    style="position: initial">check</i></span>Konfirmasi Pembayaran</a>
                                    </div>
                                @elseif($order->status == 5)
                                    <div class="stats">
                                        <a href="{{route('OrderReq.received', $order->id_order)}}"
                                           class="btn btn-primary"
                                           style="margin: 0px 0px 15px -12px"><span><i
                                                    title="Konfirmasi Pembayaran" class="material-icons"
                                                    style="position: initial">check</i></span>Pesanan Diterima</a>
                                    </div>
                                @endif
                            @endcan
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
