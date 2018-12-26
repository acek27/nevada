@extends('master.layout')

@section('title')
    History Pesanan
@endsection

@section('subtitle')
    History Pesanan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Order History</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        No. Order
                                    </th>
                                    <th>
                                        Tanggal Pemesanan
                                    </th>
                                    <th>
                                        Nama Penerima
                                    </th>
                                    <th>
                                        Alamat Penerima
                                    </th>
                                    <th>
                                        Tanggal Diterima
                                    </th>
                                    <th>
                                        Keterangan
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($done as $value)
                                    <tr>
                                        <td>
                                            {{$value->no_order}}
                                        </td>
                                        <td>
                                            {{$value->tgl_pesanan}}
                                        </td>
                                        <td>
                                            {{$value->nama_penerima}}
                                        </td>
                                        <td>
                                            {{$value->alamat}}
                                        </td>
                                        <td>
                                            {{$value->tgl_diterima}}
                                        </td>
                                        <td>
                                            @if($value->status == 6)
                                                Selesai
                                            @elseif($value->status == 7)
                                                Dibatalkan
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
