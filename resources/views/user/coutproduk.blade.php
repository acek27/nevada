@extends('master.layout')

@section('title')
    Checkout
@endsection

@section('subtitle')
    Checkout
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title"><strong>FORM</strong> Checkout</h4>
                </div>
                <div class="col-lg-12" style="margin-top: 3%">
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="/images/{{$produk->image}}" width="150px" style="height: auto">
                        </div>
                        <div class="col-lg-8" style="margin-left: 10px">
                            <h4 style="font-size: 15px"><strong>{{$produk->nama_produk}} - NEVADA</strong></h4>
                            <strong>Size</strong>
                            <div style="margin-left: 10px"> {{$produk->size->size}} </div>
                            <strong>Warna</strong>
                            <div style="margin-left: 10px"> {{$produk->warna->warna}} </div>
                            <strong>Deskripsi</strong>
                            <div style="margin-left: 10px"> {{$produk->deskripsi}} </div>
                            <strong>Harga</strong>
                            <div style="margin-right:100px;font-size: 25px; color:yellowgreen">
                                <strong>Rp{{number_format($produk->harga,2,',','.')}}</strong></div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::model($produk,['url'=>route('OrderReq.update',$produk->id_produk), 'method'=>'put']) !!}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama" class="bmd-label-floating">Nama Penerima</label>
                                    <input type="text" name="nama" class="form-control" value="{{$user}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="almt" class="bmd-label-floating">Alamat Lengkap</label>
                                    <textarea name="almt" rows="5" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nohp" class="bmd-label-floating">No. Handphone</label>
                                    <input type="text" name="nohp" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="eks" class="bmd-label-floating">Ekpedisi</label>
                                    <select name="eks" id="eks" class="form-control">
                                        @foreach($ekspedisi as $value)
                                            <option
                                                value="{{$value->id_ekspedisi}}">{{$value->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="total" class="bmd-label-floating">Total Pembayaran</label>
                                    <input type="text" name="total" class="form-control" value="Rp{{number_format($produk->harga+10000,2,',','.')}}" disabled>
                                    <input type="hidden" name="tot" class="form-control" value="{{$produk->harga+10000}}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer">
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="material-icons">close</i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="material-icons">done</i> Checkout
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
