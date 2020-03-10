@extends('layouts/layout')

@section('title', 'dateSelect')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/booking/booking.css ')}}"/>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <script>alert('{{$error}}');</script>
        @endforeach
    @endif

    <script>
        $(function() {
          
            //ボタン押下チェック
            $(".bookingCheck").click(function(){
                $(this).children(".selDate").attr("name", "selDate");
                $(this).children(".selTime").attr("name", "selTime");
                $('form').attr('action', "{{ route('booking.confirm') }}");
                $('form').submit();
            });
            $(".weekBtn").click(function(){
                $('form').attr('action', "{{ route('booking.date') }}?week="+$(this).val());
                $('form').attr('method', "POST");
                $('form').submit();
            });
        });
    </script>
@endsection

@section('content')
<form action="" method="post" >
@csrf
<!-- 選択メニュー保持 -->
@foreach($nailMenu as $selMenu)
    <input type="hidden" name="nailMenu[]" value="<?php echo $selMenu; ?>" />
@endforeach
    <div id="title">
        <h1>{!! $initData vh[1]['label']->booking[0]->booking_title !!}</h1>
    </div>

    <div id="weekBtnDiv">
        <div><button type="button" class="weekBtn" value="{{ $startDay-1 }}">
            {!! $initData[1]['label']->booking[0]->booking_prev !!}</button></div>
        <div><button type="button" class="weekBtn" value="0">
            {!! $initData[1]['label']->booking[0]->booking_now !!}</button></div>
        <div><button type="button" class="weekBtn" value="{{ $startDay+1 }}">
            {!! $initData[1]['label']->booking[0]->booking_next !!}</button></div>
    </div>
    <table id="dateTbl"> 
        <tr>
            <td>
            <!-- time -->
            </td>
                @php
                    $week = array();
                @endphp
                @for($row=0; $row<7; $row++)
                    @php
                        $week[$row] = date("m/d", strtotime("+".($row+($startDay*7))." day"))
                    @endphp
                    <td>
                        {{ $week[$row] }}
                    </td>
                @endfor
        </tr>
        @for($trRow=0; $trRow<13; $trRow++)
            <tr>
                @php
                    $time[$trRow] = date("H:i", strtotime("10:00 +".($trRow+($startDay*7))." hours"));
                @endphp
                <td>
                    {{$time[$trRow]}}
                </td>
                @for($tdRow=0; $tdRow<7; $tdRow++)
                    <td>
                    <!-- 基準日　AND　前時間帯の場合。 -->
                    @if((!strcmp($week[$tdRow], $today)) && ($time[$trRow] < $nowTime))
                        <span>✖</span>
                    @else
                        @foreach($bookings as $booking)
                            @if(!strcmp($week[$tdRow], date('m/d', strtotime($bookings[0]->reservation))) && !strcmp($time[$trRow], date('H:i', strtotime($booking->reservation))))
                                <span>✖</span>
                                @php 
                                    goto nextDateCheck; 
                                @endphp
                            @endif
                        @endforeach

                        @if(strcmp(date("w", strtotime("+".$tdRow." day")), "0"))
                            <button class="bookingCheck">〇
                                <input type="hidden" class="selDate" value="{{$week[$tdRow]}}"/>
                                <input type="hidden" class="selTime" value="{{$time[$trRow]}}"/>
                            </button>
                        @else
                            <!-- //日曜日休み -->
                            <span>✖</span>
                        @endif
                        @php
                            nextDateCheck: continue;
                        @endphp
                    @endif
                    </td>
                @endfor
            </tr>
        @endfor
    </table>
</form>
@endsection