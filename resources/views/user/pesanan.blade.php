@extends('master.layout')

@section('title')
    Detail Produk
@endsection

@section('subtitle')
    Produk
@endsection

@section('content')
    @foreach($order as $value)
        {{$value->produk->nama_produk}}
    @endforeach
@endsection
