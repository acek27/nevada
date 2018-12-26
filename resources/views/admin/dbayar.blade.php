@extends('master.layout')

@section('title')
    Detail Pembayaran
@endsection

@section('subtitle')
    Detail Pembayaran
@endsection

@section('content')
    <div class="col-lg-11">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title"><strong>Detail Pembayaran</strong> INFO</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="/images/{{$verify->bukti_bayar}}" width="100%" max-width="350px" height="450px"
                             style="height: auto">
                    </div>
                    <div class="col-lg-6">
                        <br>
                        <div class="table-responsive">
                            <table class="table">
                                <h4 style="font-size: 20px"><strong>Bukti Pembayaran No. Order {{$order->no_order}}</strong></h4>
                                <thead>
                                <tr>
                                    <th>
                                        <strong>Tanggal Pembayaran</strong>
                                    </th>
                                    <td>
                                        <div> {{$verify->tgl_bayar}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Nama Bank</strong>
                                    </th>
                                    <td>
                                        <div> {{$verify->nama_bank}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Nomor Rekening</strong>
                                    </th>
                                    <td>
                                        <div> {{$verify->no_rek}} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <strong>Nama Pemilik Rekening</strong>
                                    </th>
                                    <td>
                                        <div> {{$verify->a_n}} </div>
                                    </td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <a href="{{route('Order.batal',$order->id_order)}}" class="btn btn-danger"
                                   style="margin: 0px 0px 15px -12px"><span><i
                                            title="Batalkan Order" class="material-icons"
                                            style="position: initial">close</i>Batalkan Order</span></a>
                                <a href="{{route('Order.verify',$order->id_order)}}" class="btn btn-success"
                                   style="margin: 0px 0px 15px 25px"><span><i
                                            title="Verifikasi Pembayaran" class="material-icons"
                                            style="position: initial">check</i>Verifikasi Pembayaran</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
