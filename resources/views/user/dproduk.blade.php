@extends('master.layout')

@section('title')
    Detail Produk
@endsection

@section('subtitle')
    Produk
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title"><strong>Detail Produk</strong> INFO</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="/images/{{$produk->image}}" width="450px" height="550px">
                    </div>
                    <div class="col-lg-6">
                        <br>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <th style="font-size: 25px"><strong>{{$produk->nama_produk}} - NEVADA</strong></th>
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
                                        <div style="font-size: 20px; color: darkviolet">
                                            <strong>Rp{{number_format($produk->harga,2,',','.')}}</strong></div>
                                    </td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

@endsection
