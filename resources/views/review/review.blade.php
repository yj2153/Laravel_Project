@extends('layouts/layout')

@section('title', 'Review')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/review/review.css ')}}"/>
@endsection

@section('content')
<div id="content">
    <form action="" method="post">
        @csrf
        <table id="inputTbl">
            <tr>
                <td>
                    @if(!empty($initData[2]['user']))
                        {!! $initData[2]['user']->name !!}
                        {!! $initData[1]['label']->review[0]->review_info !!}
                    @else
                        {!! $initData[1]['label']->review[0]->review_comment !!}
                    @endif
                </td>
            </tr>
            </tr>   
                <td>
                    <textarea name="message" cols="50" rows="5" {{ empty($initData[2]['user']) ? 'disabled="true"' : '' }}>{{$message}}</textarea>
                    <input type="hidden" name="reply_post_id" value="{{ $res }}"/>
                </td>
            </tr> 
            <tr>
                <td>
                    @if(!empty($initData[2]['user']))
                        <input type="submit" value="{{$initData[1]['label']->review[0]->review_submit }}"/>
                    @endif
                </td>
            </tr>  
        </table>

    <table id="msgDiv">
    @foreach($posts as $post)
        <tr>
            <td>
                <div class="msg">
                    <div class="name">{{$post->member->getName()}}
                        [<a href="{{route('review').'?res='.$post->id}}">re</a>]
                    </div>
                    <div>
                        {{$post->message }}
                    </div>
                    <div class="day">
                        {{$post->created }}
                        
                        @if(!empty($initData[2]['user']) && !strcmp($initData[2]['user']->id, $post->member_id))
                            [<a href="{{route('review.delete').'?id='.$post->id}}" style="color:#F33;">{!! $initData[1]['label']->review[0]->review_delete !!}</a>]
                        @endif
                    </div>
                </div>
            </td>
        </tr>
        @if(!empty($post->replys))
            @foreach($post->replys as $reply)
            <tr>
                <td class="reMsg">
                    <div class="msg">
                        <div class="name">{{$reply->member->getName()}}</div>
                        <div>
                            {{$reply->getMessage() }}
                        </div>
                        <div class="day">
                            {{$reply->getCreate() }}
                            
                            @if(!empty($initData[2]['user']) && !strcmp($initData[2]['user']->id, $reply->getMemberID()))
                                [<a href="{{route('review.delete').'?id='.$reply->getID()}}" style="color:#F33;">{!! $initData[1]['label']->review[0]->review_delete !!}</a>]
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        @endif
    @endforeach
    </table>

    {{$posts->links()}}
</div>
@endsection