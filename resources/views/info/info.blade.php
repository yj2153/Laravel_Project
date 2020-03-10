@extends('layouts/layout')

@section('title', 'Info')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/info/info.css ')}}"/>
@endsection

@section('content')
<div style="width: 90%; margin: 0 auto;">
    <table id="infoTbl">
        <tr>
            <td>
                <h1>{!! $initData[1]['label']->info[0]->info_title !!}</h1>
            </td>
        </tr>
        <tr>
            <td>
               <span>{!! $initData[1]['label']->info[0]->info_msg !!}</span>
            </td>
        </tr>
        <tr>
            <td>
                {!! $initData[1]['label']->info[0]->info_tel_msg !!}
            </td>
        </tr>
        <tr>
            <td>
                {!! $initData[1]['label']->info[0]->info_time_msg !!}
            </td>
        </tr> 
    </table>
</div>
@endsection

@section('footer')
sdfsdft
@endsection