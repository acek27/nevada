@extends('master.layout')

@section('title')
    @if($status == 6)
        Order Selesai
    @elseif($status == 7)
        Order Batal
    @endif
@endsection

@section('subtitle')
    @if($status == 6)
        Order Selesai
    @elseif($status == 7)
        Order Batal
    @endif
@endsection

@section('content')
    <div class="col-md-12 table-responsive">
        {!! $html->table(['class'=>'bordered-table display']) !!}
        {!! $html->scripts() !!}
    </div>
@endsection
