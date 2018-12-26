@extends('master.layout')

@section('title')
    Konfirmasi Pembayaran
@endsection

@section('subtitle')
    Konfirmasi Pembayaran
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title"><strong>FORM</strong> Edit Produk</h4>
                </div>
                <div class="card-body">
                    {!! Form::model($order,['url'=>route('OrderReq.konfirmasi',$order->id_order),'method'=>'put', 'files' => true]) !!}
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Bukti Transfer</label>
                            </div>
                            <input type="file" onchange="readURL(this);" id="image" name="image"
                                   class="form-control-file">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bank" class="bmd-label-floating">Nama Bank</label>
                                        <select name="bank" id="bank" class="form-control">
                                            <option value="BRI">BRI</option>
                                            <option value="BNI">BNI</option>
                                            <option value="BTN">BTN</option>
                                            <option value="BCA">BCA</option>
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="Bank Jatim">Bank Jatim</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: 33px">
                                    <div class="form-group">
                                        <label for="rek" class="bmd-label-floating">Nomor Rekening</label>
                                        <input type="text" name="rek" class="form-control" maxlength="16" minlength="10" value="{{old('rek')}}" required>
                                        @if($errors->any())
                                            {!! $errors->first('rek', '<p style="font-size: 10px; color:red">No. Rekening Harus Berupa Angka (10 - 16 Digit)</p>') !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="an" class="bmd-label-floating">Atas Nama</label>
                                <input type="text" name="an" class="form-control" value="{{old('an')}}" required>
                            </div>
                            <div class="form-group">
                                <label class="">Tanggal Transfer</label>
                            </div>
                            <input type="date" name="tgltf" class="form-control" value="{{old('tgltf')}}" required>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="card-footer">
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="material-icons">close</i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="material-icons">update</i> Konfirmasi
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="height: 90%">
                <div class="card-header card-header-warning">
                    <h4 class="card-title">Image Preview</h4>
                </div>

                <div class="card-body table-responsive" style="height: 465px">
                    <img id="blah" src="/images/{{$order->image}}" alt=""
                         style="width:100%;max-width: 100%;max-height: 100%">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
