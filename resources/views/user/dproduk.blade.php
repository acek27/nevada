@extends('master.layout')

@section('title')
    Detail Produk
@endsection

@section('subtitle')
    Produk
@endsection

@section('content')
    <div class="col-lg-11">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title"><strong>Detail Produk</strong> INFO</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="/images/{{$produk->image}}" width="450px" height="550px" style="height: auto">
                    </div>
                    <div class="col-lg-6">
                        <br>
                        <div class="table-responsive">
                            <table class="table">
                                <h4 style="font-size: 25px"><strong>{{$produk->nama_produk}} - NEVADA</strong></h4>
                                <thead>
                                <tr>
                                    <th>
                                        <strong>Size</strong>
                                    </th>
                                    <td>
                                        <div> {{$produk->size->size}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Warna</strong>
                                    </th>
                                    <td>
                                        <div> {{$produk->warna->warna}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Deskripsi</strong>
                                    </th>
                                    <td>
                                        <div> {{$produk->deskripsi}} </div>
                                    </td>
                                </tr> <tr>
                                    <th>
                                        <strong>Stok</strong>
                                    </th>
                                    <td>
                                        <div> {{$produk->stok}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Harga</strong>
                                    </th>
                                    <td>
                                        <div style="margin-right:100px;font-size: 25px; color:yellowgreen">
                                            <strong>Rp{{number_format($produk->harga,2,',','.')}}</strong></div>
                                    </td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <a href="{{route('OrderReq.show',$produk->id_produk)}}" class="btn btn-warning"
                                   style="margin: 0px 0px 15px -12px"><span><i
                                            title="tambahkan ke keranjang" class="material-icons"
                                            style="position: initial">add_shopping_cart</i></span></a>
                                <a href="{{route('OrderReq.show',$produk->id_produk)}}" class="btn btn-success"
                                   style="margin: 0px 0px 15px 25px"><span>Beli Sekarang</span></a>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

@endsection
