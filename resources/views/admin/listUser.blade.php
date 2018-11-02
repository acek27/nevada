@extends('master.layout')

@section('title')
    Daftar Customer
@endsection

@section('subtitle')
    Daftar Customer
@endsection

@section('content')
    <div class="col s12 m8 19">
        {!! $html->table(['class'=>'bordered-table display']) !!}
        {!! $html->scripts() !!}
    </div>
@endsection
