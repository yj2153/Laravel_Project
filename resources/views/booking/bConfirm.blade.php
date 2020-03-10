@extends('layouts/layout')

@section('title', 'confirm')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/booking/confirm.css ')}}"/>
@endsection

@section('content')
<form action="{{ route('booking.complete') }}" method="post">
@csrf
<!-- 選択メニュー保持 -->
@foreach($nailMenu as $selMenu)
    <input type="hidden" name="nailMenu[]" value="{{ $selMenu }}" />
@endforeach
<input type="hidden" name="selDate" value="{{$selDate}}" />
<input type="hidden" name="selTime" value="{{$selTime}}" />

<div id="title">
    <h1>{!! $initData[1]['label']->booking[0]->booking_check_title !!}</h1>
</div>
<div id="checkTblDiv">
    <table id="checkTbl">
        <tr>
            <td colspan="2">
                <h3>{!! $initData[1]['label']->booking[0]->booking_sel_date !!}</h3>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <span>{!! $selDate !!}&nbsp;{!! $selTime !!}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <h3>{!! $initData[1]['label']->booking[0]->booking_sel_menu !!}</h3>
            </td>
        </tr>
        @foreach($nails as $nail)
            @if(!empty($nail->type))
            <tr>
                <td></td>
                <td>
                    @if(!strcmp($initData[0]['lang'], 'ja'))
                        {{$nail->title}}
                    @else
                        {{$nail->title_ko}}
                    @endif
                </td>
            </tr>
            @else
            <tr>
                <td colspan="2">
                    <h3>{!! $initData[1]['label']->booking[0]->booking_sel_price !!}</h3>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    @if(!strcmp($initData[0]['lang'], 'ja'))
                        {{ ($nail->price).$initData[1]['label']->booking[0]->booking_type_unit }}
                    @else
                        {{ ($nail->price_ko).$initData[1]['label']->booking[0]->booking_type_unit }}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>{!! $initData[1]['label']->booking[0]->booking_sel_time !!}</h3>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    {{ $nail->useTime }}
                </td>
            </tr>
            @endif
        @endforeach
    </table>
</div>
<div id="btnDiv"><input type="submit" value="{{ $initData[1]['label']->booking[0]->booking_insert}}"/></div>
</form>
@endsection