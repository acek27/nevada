@extends('master.layout')

@section('title')
    Beranda
@endsection

@section('subtitle')
    Beranda
@endsection

@section('content')
    <div class="col-md-12 table-responsive">
        {!! $html->table(['class'=>'bordered-table display']) !!}
        {!! $html->scripts() !!}
    </div>
@endsection
