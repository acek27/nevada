@extends('master.layout')

@section('title')
    Pesanan
@endsection

@section('subtitle')
    Pesanan
@endsection

@section('content')
    <div class="col-md-12 table-responsive">
        {!! $html->table(['class'=>'bordered-table display']) !!}
        {!! $html->scripts() !!}
    </div>
@endsection
