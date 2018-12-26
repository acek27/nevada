@extends('master.layout')

@section('title')
    Keranjang Belanja
@endsection

@section('subtitle')
    Keranjang Belanja
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="padding-bottom: 25px">
                <div class="card-header card-header-primary">
                    <h4 class="card-title"><strong>Detail</strong> Cart</h4>
                </div>

                <div class="col-lg-12">
                    @foreach($cart as $value)
                        <div class="row">
                            <div class="col-lg-2" style="margin-top: 3%; margin-left: 3%">
                                <img src="/images/{{$value->produk->image}}" max-width="200px" width="60%"
                                     style="height: auto">
                            </div>
                            <div style="margin-left: -30px; margin-top: 3%">
                                <h4 style="font-size: 15px"><strong>NEVADA</strong></h4>
                                <div
                                    style="font-size: 13px; margin-top: -10px; color: darkgray">{{$value->produk->nama_produk}}
                                    - {{$value->produk->warna->warna}}</div>
                                <div style="font-size: 13px; margin-top: -2px">Size
                                    : {{$value->produk->size->size}} </div>
                            </div>
                            <div class="col-lg-2" style="margin-top: 3%; margin-left: 3%">
                                <h4 style="text-align: center; font-size: 15px"><strong>Harga/pcs</strong></h4>
                                <div style="font-size: 14px; color:yellowgreen; text-align: center">
                                    <strong>Rp{{number_format($value->produk->harga,2,',','.')}}</strong></div>
                            </div>
                            <div class="col-lg-2" style="margin-top: 3%">
                                <h4 style="text-align: center; font-size: 15px"><strong>Qty</strong></h4>
                                <input style="text-align: center" type="number" name="qty" class="form-control"
                                       value="{{$value->qty}}" min="1" max="{{$value->produk->stok}}">
                            </div>
                            <div class="col-lg-2" style="margin-top: 3%; margin-left: 2%">
                                <h4 style="text-align: center; font-size: 15px"><strong>Jumlah</strong></h4>
                                <div style="font-size: 14px; color:yellowgreen; text-align: center">
                                    <strong>Rp{{number_format($value->produk->harga * $value->qty,2,',','.')}}</strong>
                                </div>
                            </div>
                            <div class="col-lg-2" style="margin-top: 5%">
                                <a href="{{route('Cart.delCart', $value->id_order)}}"
                                   class="btn btn-sm btn-danger"><span><i title="Hapus"
                                                                          class="material-icons">delete</i></span></a>
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="row">
                        <div class="col-lg-2" style="margin-left: 3.5%; margin-top: 1%">
                            <h4 style="text-align: left; font-size: 15px"><strong>Total Belanja</strong></h4></div>
                        <div
                            style="font-size: 14px; color:yellowgreen; text-align: center; margin-left: 49.5%; margin-top: 1%">
                            <strong>Rp{{number_format($value->produk->harga * $value->qty,2,',','.')}}</strong>
                        </div>
                        <div class="col-lg-2" style="margin-left: 4%">
                            <a href="{{route('OrderReq.show', $value->id_produk)}}" class="btn btn-sm btn-success"
                               title="Beli Sekarang">Beli Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
