@extends('master.layout')

@section('title')
    Wishlist
@endsection

@section('subtitle')
    Wishlist
@endsection

@section('content')
    @if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
        </div>
    @endif

    <div class="row" style="margin-top: -2%">
        @foreach($wish as $value)
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-header"
                         title="{{$value->produk->nama_produk}} {{$value->produk->warna->warna}} - {{$value->produk->size->size}}">
                        <a href="{{route('produkUser.show',$value->produk->id_produk)}}">
                            <img src="/images/{{$value->produk->image}}" alt="Daster" width="100%" max-width="200px"
                                 height="275px"
                                 style="height: auto; margin-top: 1.5%"></a>
                    </div>
                    <div style="margin: 0% 0% 0% 8%">
                        <h5><strong>{{$value->produk->nama_produk}} {{$value->produk->warna->warna}}
                                - {{$value->produk->size->size}}</strong></h5>
                        </a>
                        <h6 style="margin: -10px 0px 10px 0px; font-size: 10px; color: grey"><i class="material-icons"
                                                                                                0
                                                                                                style="font-size: 8px; color: dodgerblue; margin-right: 5px">fiber_manual_record</i>{{$value->produk->kategori->nama_kategori}}
                        </h6>
                        <div class="row">
                            <div style="margin-left: 5%">
                                <h3 class="header-title" style="margin-top: -10px; color:#7f231c"><strong>
                                        Rp{{number_format($value->produk->harga,2,',','.')}}</strong>
                                </h3>
                            </div>
                            <div style="margin-left: 10%; margin-top: -5px">
                                <a href="{{route('Wishlist.unwish', $value->id_wish)}}" id="wish" title="Hapus Wishlist"><i
                                        class="material-icons" style="color: red">favorite</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

{{--@section('script')--}}
{{--<script>--}}
{{--$('#wish').click(function () {--}}
{{--$.ajax({--}}
{{--url: "/kuesioner/" + $('#idkuesioner').val(),--}}
{{--}).done(function (msg) {--}}
{{--alert("Update!", "Data sudah terupdate.", "success");--}}
{{--location.reload();--}}
{{--}).fail(function (textStatus) {--}}
{{--alert("Request failed: " + textStatus);--}}
{{--});--}}
{{--});--}}
{{--</script>--}}
{{--@endsection--}}
