@extends('master.layout')

@section('title')
    Edit Produk
@endsection

@section('subtitle')
    Produk
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title"><strong>Edit Product</strong> FORM</h4>
                </div>
                <div class="card-body">
                    {!! Form::model($produk,['url'=>route('produk.update',$produk->id_produk),'method'=>'put', 'files' => true]) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Gambar Produk</label>
                            </div>
                            <input type="file" onchange="readURL(this);" id="image" name="image" class="form-control">
                            <div class="form-group">
                                <label for="pdname" class="bmd-label-floating">Nama Produk</label>
                                <input type="text" name="pdname" class="form-control" value="{{$produk->nama_produk}}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stok" class="bmd-label-floating">Stok Produk</label>
                                        <input type="text" name="stok" class="form-control" value="{{$produk->stok}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                            <div class="form-group">
                                <label for="pdharga" class="bmd-label-floating">Harga</label>
                                <input type="text" name="pdharga" class="form-control" value="{{$produk->harga}}">
                            </div></div></div>
                            <div class="form-group">
                                <label for="pddeskrip" class="bmd-label-floating">Deskripsi Produk</label>
                                <textarea name="pddeskrip" rows="5"
                                          class="form-control">{{$produk->deskripsi}}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="size" class="bmd-label-floating">Size</label>
                                        <select name="size" class="form-control">
                                            @foreach($size as $value)
                                                <option value="{{$value->id_size}}"
                                                        @if($value->id_size == $produk->id_size)
                                                        selected="selected"
                                                    @endif
                                                >{{$value->size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="warna" class=" form-control-label">Warna</label>
                                        <select name="warna" id="warna" class="form-control">
                                            @foreach($warna as $value)
                                                <option
                                                    @if($value->id_warna == $produk->id_warna)
                                                        selected="selected"
                                                        @endif
                                                    value="{{$value->id_warna}}">{{$value->warna}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kategori" class=" form-control-label">Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control">
                                            @foreach($kategori as $value)
                                                <option
                                                    @if($value->id_kategori == $produk->id_kategori)
                                                        selected="selected"
                                                    @endif
                                                    value="{{$value->id_kategori}}">{{$value->nama_kategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-footer">
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="material-icons">close</i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="material-icons">update</i> Update
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title">Image Preview</h4>
                </div>

                <div class="card-body table-responsive" style="height: 620px">
                    <img id="blah" src="/images/{{$produk->image}}" alt=""
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
