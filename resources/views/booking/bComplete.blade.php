@extends('layouts/layout')

@section('title', 'complete')

@section('stylesheet')
@endsection

@section('content')
<div style="text-align:center; margin-top:50px;">
    <p>{!! $initData[1]['label']->bookingOK[0]->bookingOK_info !!}</p>
    <p><a href="{{ route('booking.confirmList') }}">{!! $initData[1]['label']->bookingOK[0]->bookingOK_confirm !!}</a></p>
</div>
@endsection