@extends('master.layout')

@section('title')
    List Produk
@endsection

@section('subtitle')
    List Produk
@endsection

@section('content')
    @if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
        </div>
    @endif

    <div class="col-md-12 table-responsive">
        {!! $html->table(['class'=>'bordered-table display']) !!}
        {!! $html->scripts() !!}
    </div>
@endsection
