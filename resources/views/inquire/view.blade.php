@extends('layouts/layout')

@section('title', 'InquireView')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/inquire/listView.css ')}}"/>
@endsection

@section('content')
<div id="title">
    <h1>{!! $initData[1]['label']->inquire[0]->inquire_top_title !!}</h1>
</div>
<div id="buttonDiv">
    @if(!empty($initData[2]['user']) && !strcmp($initData[2]['user']->id, $inquire->member_id))
        <button onclick="location.href='{{route('inquire.regist').'?listNum='.$listNum}}'">{!! $initData[1]['label']->inquire[0]->inquire_change !!}</button>
    @endif
</div>
<form action="" method="post">
    @csrf
    <table id="viewTbl">
        <tr>
            <td style="width:100px;">{!! $initData[1]['label']->inquire[0]->inquire_title !!}</td>
            <td colspan="2">{{ $inquire->title }}
            </td>
        </tr>
        <tr>
            <td>{!! $initData[1]['label']->inquire[0]->inquire_name !!}</td>
            <td>{{ $inquire->member->getName() }}</td>
        </tr>
        <tr>
            <td colspan="3">
                <div id="msgView">{!! $inquire->message !!}</div>
            </td>
        </tr>
        @foreach($comments as $comment)
        <tr>
            <td>
                @if(!empty($comment->replyMember))
                    {{ $comment->replyMember->getName() }}
                @endif
            </td>
            <td>
                {{ $comment->message }}
            </td>
            <td style="text-align:center;">
                @if(!empty($initData[2]['user']) && !strcmp($initData[2]['user']->id, $comment->member_id))
                    <a href="{{route('inquire.view.cDelete').'?listNum='.$listNum.'&reply_id='.$comment->id}}">
                    {!! $initData[1]['label']->inquire[0]->inquire_delete !!}</a>
                @endif
            </td>
        </tr>
        @endforeach
        
        @if(!empty($initData[2]['user']))
            <tr>
                <td>
                    {{$initData[2]['user']->name}}
                </td>
                <td>
                    <textarea name="message" rows="5"></textarea>
                    <input type="hidden" name="listNum" value="{{$listNum}}"/>
                </td>
                <td>
                    <input type="submit" value="{{ $initData[1]['label']->inquire[0]->inquire_submit }}"/>
                </td>
            <tr>
        @else
            <tr>
                <td colspan="3">
                   {!! $initData[1]['label']->inquire[0]->inquire_comment !!}
                </td>
            </tr>
        @endif
    </table>
</form>
@endsection