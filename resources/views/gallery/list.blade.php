@extends('layouts/layout')

@section('title', 'galleryList')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/gallery/list.css ')}}"/>
@endsection

@section('content')
<div id="content">
    <div id="title">
        <h1>{!! $initData[1]['label']->gallery[0]->gallery_list_title !!}</h1>
    </div>
    <div id="rigistBtnDiv">
        @if(!empty($initData[2]['user']))
            <button onclick="location.href='{{route('gallery.regist')}}'">{!! $initData[1]['label']->gallery[0]->gallery_submit !!}</button>
        @endif
    </div>
    <div id="listTblDiv">
        <table id="listTbl">
            @for($trCnt=0; $trCnt<count($imgList); $trCnt+=4)
                <tr class="line">
                    @for($tdCnt=$trCnt; $tdCnt<($trCnt+4); $tdCnt++)
                        @if($tdCnt >= (count($imgList)))
                            <td></td>
                            @continue
                         @endif
                         
                    <td onclick="location.href='{{route('gallery.view').'?listNum='.($imgList[$tdCnt]->id)}}';">
                        <table id="lineTbl">
                            <tr>
                                <td class="lineTitle">
                                    <span>{!! "No.".($tdCnt + 1)."  ".($imgList[$tdCnt]->title) !!}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="lineImg">
                                    <img src="{{asset('/assets/image').'/'.$imgList[$tdCnt]->picture}}" width="150" height="150" alt=""/>
                                </td>
                            </tr>
                            <tr>
                                <td class="lineDate">
                                    {!! ($imgList[$tdCnt]->created) !!}
                                </td>
                            </tr>
                        </table>
                    </td>
                    @endfor
                </tr>
            @endfor
        </table>
    </div>
    {{$imgList->links()}}
</div>
@endsection
