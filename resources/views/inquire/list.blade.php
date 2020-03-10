@extends('layouts/layout')

@section('title', 'InquireList')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/inquire/inquire.css ')}}"/>
@endsection

@section('content')
<div id="title">
    <h1>{!! $initData[1]['label']->inquire[0]->inquire_top_title !!}</h1>
</div>
<div id="rigistBtnDiv">
    @if(!empty($initData[2]['user']))
        <button onclick="location.href='{{route('inquire.regist')}}'">
        {!! $initData[1]['label']->inquire[0]->inquire_submit !!}</button>
    @endif
</div>
<table id="listTbl">
    @foreach($inquireList as $inquire)
        <tr class="line" onclick="location.href='{{route('inquire.view').'?listNum='.$inquire->id}}'">
            <td>
                <table id="lineTbl" >
                    <tr>
                        <td class="lineNum">
                            <span>{{ $inquire->id }}</span>
                        </td>
                        <td class="lineTitle">
                            {{ $inquire->title }}
                        </td>
                        <td class="lineDate">
                            {{$inquire->created}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    @endforeach
</table>
{{$inquireList->links()}}
@endsection