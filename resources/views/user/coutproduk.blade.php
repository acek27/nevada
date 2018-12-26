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
                        <div class="col-lg-3" style="margin-left: 3%">
                            <img src="/images/{{$produk->image}}" max-width="200px" width="60%" style="height: auto">
                        </div>
                        <div class="col-lg-8" style="margin-left: -10%">
                            <h4 style="font-size: 15px"><strong>NEVADA</strong></h4>
                            <div style="font-size: 13px; margin-top: -10px; color: darkgray">{{$produk->nama_produk}}
                                - {{$produk->warna->warna}}</div>
                            <div style="font-size: 13px; margin-top: -2px">Size : {{$produk->size->size}} </div>
                            <div style="font-size: 20px; color:yellowgreen">
                                <strong>Rp{{number_format($produk->harga,2,',','.')}}</strong></div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(['url'=>route('OrderReq.update', $produk->id_produk), 'method'=>'put']) !!}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama" class="bmd-label-floating">Nama Penerima</label>
                                    <input type="text" name="nama" class="form-control" value="{{$user}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="almt" class="bmd-label-floating">Alamat Lengkap</label>
                                    <textarea name="almt" rows="5" class="form-control" required>{{old('almt')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nohp" class="bmd-label-floating">No. Handphone</label>
                                    <input type="text" name="nohp" class="form-control" value="{{old('nohp')}}" maxlength="13" minlength="9" required>
                                    @if ($errors->any())
                                        {!! $errors->first('nohp', '<p style="font-size: 10px; color:red">No. Handphone Harus Berupa Angka (9 - 13 Digit)</p>') !!}
                                    @endif
                                </div>
                                {{--<div class="row">--}}
                                {{--<div class="col-md-6">--}}
                                <div class="form-group">
                                    <label for="eks" class="bmd-label-floating">Ekpedisi</label>
                                    <select name="eks" id="eks" class="form-control">
                                        @foreach($ekspedisi as $value)
                                            <option
                                                value="{{$value->id_ekspedisi}}">{{$value->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--</div>--}}
                                {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                {{--<label for="ongkir" class="bmd-label-floating">Ongkos Kirim</label>--}}
                                {{--<input type="text" name="ongkir" class="form-control"--}}
                                {{--value="" disabled>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label for="vtotal" class="bmd-label-floating">Total Pembayaran</label>
                                    <input type="text" name="vtotal" class="form-control"
                                           value="Rp{{number_format($produk->harga+10000,2,',','.')}}" disabled
                                    ></input>
                                </div>
                                <input type="text" name="total" class="form-control" hidden
                                       value="{{$produk->harga+10000}}"
                                ></input>
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
