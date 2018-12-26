@extends('master.layout')

@section('title')
    Hasil Pencarian
@endsection

@section('subtitle')
    Hasil Pencarian
@endsection

@section('content')
    <div class="row" style="margin-top: -2%">
        @foreach($data as $value)
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-header"
                         title="{{$value->nama_produk}} {{$value->warna->warna}} - {{$value->size->size}}">
                        <a href="{{route('produkUser.show',$value->id_produk)}}">
                            <img src="/images/{{$value->image}}" alt="Daster" width="100%" max-width="200px"
                                 height="275px"
                                 style="height: auto; margin-top: 1.5%"></a>
                    </div>
                    <div style="margin: 0% 0% 0% 8%">
                        <h5><strong>{{$value->nama_produk}} {{$value->warna->warna}}
                                - {{$value->size->size}}</strong></h5>
                        </a>
                        <h6 style="margin: -10px 0px 10px 0px; font-size: 10px; color: grey"><i class="material-icons"
                                                                                                0
                                                                                                style="font-size: 8px; color: dodgerblue; margin-right: 5px">fiber_manual_record</i>{{$value->kategori->nama_kategori}}
                        </h6>
                        <div class="row">
                            <div style="margin-left: 5%">
                                <h3 class="header-title" style="margin-top: -10px; color:#7f231c"><strong>
                                        Rp{{number_format($value->harga,2,',','.')}}</strong>
                                </h3>
                            </div>
                            <div style="margin-left: 10%; margin-top: -5px">
                                @if($wish ==false)
                                    <a href="{{route('Wishlist.wish', $value->id_produk)}}" id="wish"><i
                                            class="material-icons" style="color: red">favorite_border</i></a>
                                @else
                                    <a href="{{route('Wishlist.unwish', $value->id_produk)}}" id="unwish"><i
                                            class="material-icons" style="color: red">favorite</i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
