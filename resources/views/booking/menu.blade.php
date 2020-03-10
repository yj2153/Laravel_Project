
@extends('layouts/layout')

@section('title', 'Info')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/booking/menu.css ')}}"/>
@endsection

@section('content')
<div id="content">
    <div id="title">
        <h1>{!! $initData[1]['label']->booking[0]->booking_menu_title !!}</h1>
    </div>
    <table id="listTbl">
        @foreach($nails as $nail)
            @if(!empty($nail->type) && empty($nail->title_jp))
                <tr class="lineTitle">
                    <td colspan="2" style="font-weight:bold;">
                        @if(!strcmp($nail->type, "1"))
                            {!! "・".$initData[1]['label']->booking[0]->booking_type_hand !!}
                        @elseif(!strcmp($nail->type, "2"))
                            {!! "・".$initData[1]['label']->booking[0]->booking_type_foot !!}
                        @elseif(!strcmp($nail->type, "3"))
                            {!! "・".$initData[1]['label']->booking[0]->booking_type_off !!}
                        @endif
                    </td>
                </tr>
             @elseif(!empty($nail->type)) 
                <tr class="line">
                    <td>
                        @if(!strcmp($initData[0]['lang'], 'ja'))
                            {!! $nail->title_jp !!}
                        @else
                            {!! $nail->title_ko !!}
                        @endif
                    </td>
                    <td>
                        @if(!strcmp($initData[0]['lang'], 'ja'))
                            {!! ($nail->price).$initData[1]['label']->booking[0]->booking_type_unit !!}
                        @else
                            {!! ($nail->price_ko).$initData[1]['label']->booking[0]->booking_type_unit !!}
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
</div>
@endsection