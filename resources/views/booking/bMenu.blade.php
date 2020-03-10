
@extends('layouts/layout')

@section('title', 'MenuSelct')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/booking/menu.css ')}}"/>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <script>alert('{{$error}}');</script>
        @endforeach
    @endif
@endsection

@section('content')
<form action="booking" method="post">
    @csrf
    <div id="content">
        <div id="title">
            <h1>{!! $initData[1]['label']->booking[0]->booking_menu !!}</h1>
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
                            <input type="checkbox" name="nailMenu[]" class="nailMenu" id="menu{{$nail->id}}" value="{{$nail->id}}"/>
                            @if(!strcmp($initData[0]['lang'], 'ja'))
                                <label for='menu{{$nail->id}}'>{{ $nail->title_jp }}</label>
                            @else
                                <label for='menu{{$nail->id}}'>{{ $nail->title_ko }}</label>
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
        <div id="nextBtnDiv"><input type="submit" id="nextBtn" value="{{ $initData[1]['label']->booking[0]->booking_sel_next }}"/></div>
    </div>
</form>
@endsection