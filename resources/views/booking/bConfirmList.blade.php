@extends('layouts/layout')

@section('title', 'confirmList')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/booking/bookingList.css ')}}"/>
@endsection

@section('content')
<div id="title">
    <h1>{!! $initData[1]['label']->booking[0]->booking_list_title !!}</h1>
</div>
<table id="listTbl">
    @foreach($dates as $date)
        @if(!empty($date->reservation) && empty($date->type))
            <tr class="lineTitle">
                <td colspan="2" style="font-weight:bold;">
                    ・{{$date->reservation}}
                </td>
            </tr>
        @elseif(!empty($date->reservation))
            <tr class="line">
                <td>
                    @if(!strcmp($initData[0]['lang'], 'ja'))
                        {{$date->title}}
                    @else
                        {{$date->title_ko}}
                    @endif
                        
                    @if(!strcmp($date->type, "1"))
                        {{ "(".$initData[1]['label']->booking[0]->booking_type_hand.")" }}
                    @elseif(!strcmp($date->type, "2"))
                        {{ "(".$initData[1]['label']->booking[0]->booking_type_foot.")"}}
                    @elseif(!strcmp($date->type, "3"))
                        {{ "(".$initData[1]['label']->booking[0]->booking_type_off.")" }}
                    @endif
                </td>
                <td>
                    @if(!strcmp($date->status, "1"))
                        {{$initData[1]['label']->booking[0]->booking_status_1 }}
                    @elseif(!strcmp($date->status, "2"))
                        {{$initData[1]['label']->booking[0]->booking_status_2 }}
                    @elseif(!strcmp($date->status, "3"))
                        {{$initData[1]['label']->booking[0]->booking_status_9 }}
                    @endif
                </td>
            </tr>
        @endif
    @endforeach
</table>
@endsection