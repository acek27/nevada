@extends('master.layout')

@section('title')
    Daftar Customer
@endsection

@section('subtitle')
    Daftar Customer
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
