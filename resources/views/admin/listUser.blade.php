@extends('master.layout')

@section('title')
    Daftar Customer
@endsection

@section('subtitle')
    Daftar Customer
@endsection

@section('content')
    <div class="col-md-12 table-responsive">
        {!! $html->table(['class'=>'bordered-table display']) !!}
        {!! $html->scripts() !!}
    </div>
@endsection
