@extends('master.layout')

@section('title')
    Beranda
@endsection

@section('subtitle')
    Beranda
@endsection

@section('content')
    <div class="row" style="margin-top: -2%">
        @foreach($data as $value)
            <div class="col-lg-4 col-md-6">
                <div class="card card-stats">
                    <div class="card-header" style="height: 400px"
                         title="{{$value->nama_produk}} {{$value->warna->warna}} - {{$value->size->size}}">
                        <a href="{{route('produk.show',$value->id_produk)}}" style="margin-left: 5%">
                            <img src="images/{{$value->image}}" alt="Daster" width="275px" height="350px"
                                 style="height: auto"></a>
                    </div>
                    <div style="margin: 0% 0% 0% 8%">
                        <h5><strong>{{$value->nama_produk}} {{$value->warna->warna}}
                                - {{$value->size->size}}</strong></h5>
                        </a>
                        <h6 style="margin: -10px 0px 10px 0px; font-size: 10px; color: grey"><i class="material-icons"
                                                                                                style="font-size: 8px; color: dodgerblue; margin-right: 5px">fiber_manual_record</i>{{$value->kategori->nama_kategori}}
                        </h6>
                        <h3 class="header-title" style="margin: -10px 0px 0px 0px; color:#7f231c"><strong>
                                Rp{{number_format($value->harga,2,',','.')}}</strong>
                        </h3>

                        <div class="card-footer">
                            <div class="stats">
                                <a href="{{route('produk.edit',$value->id_produk)}}" class="btn btn-warning"
                                   style="margin: 0px 0px 15px -12px"><span><i
                                            title="tambahkan ke keranjang" class="material-icons"
                                            style="position: initial">add_shopping_cart</i></span></a>
                                <a href="{{route('produk.edit',$value->id_produk)}}" class="btn btn-success"
                                   style="margin: 0px 0px 15px 25px"><span>Beli Sekarang</span></a>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
