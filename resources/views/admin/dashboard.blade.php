@extends('master.layout')

@section('title')
    Beranda
@endsection

@section('subtitle')
    Beranda
@endsection

@section('content')
    <div class="col s12 m8 19">
        {!! $html->table(['class'=>'bordered-table display']) !!}
        {!! $html->scripts() !!}
    </div>
@endsection
