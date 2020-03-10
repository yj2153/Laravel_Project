@extends('layouts/layout')

@section('title', 'InquireRegist')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/inquire/listRegist.css ')}}"/>
@if(count($errors) > 0)
    @php
        $errorMsg="";
    @endphp
    @foreach($errors->all() as $error)
        @if(!$loop->last)
            @php
                $errorMsg = $errorMsg.$error.'\n';
            @endphp
        @else
            @php
                $errorMsg = $errorMsg.$error;
            @endphp
        @endif
    @endforeach
    <script>alert('{{ nl2br($errorMsg) }}');</script>
@endif
@endsection

@section('content')
<div id="title">
    <h1>{!! $initData[1]['label']->inquire[0]->inquire_top_title !!}</h1>
</div>
<form action="" method="post">
    @csrf
    <table id="viewTbl">
        <tr>
            <td>{!! $initData[1]['label']->inquire[0]->inquire_title !!}</td>
            <td>
                <input type="text" name="title" value="{{old('title')}}" />
            </td>
        </tr>
        <tr>
            <td>{!! $initData[1]['label']->inquire[0]->inquire_message !!}</td>
            <td>
                <textarea name="message" rows="15">{{old('message')}}</textarea>
            </td>
        </tr>
    </table>
    <div id="buttonDiv">
        <input type="submit" value="{!! $initData[1]['label']->inquire[0]->inquire_submit !!}"/>
    </div>
</form>
@endsection