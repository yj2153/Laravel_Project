@extends('layouts/layout')

@section('title', 'galleryView')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/gallery/view.css ')}}"/>
@endsection

@section('content')
<form action="" method="post">
    <table id="viewTbl">
        <tr>
            <td>{!! $initData[1]['label']->gallery[0]->gallery_title !!}</td>
            <td colspan="2">{{ $gallery->title}}</td>
        </tr>
        <tr>
            <td colspan="2">
                <img src="{{asset('/assets/image').'/'.($gallery->picture) }}" width="{{$width}}" height="{{$height}}" alt=""/>
            </td>
        </tr>
    </table>
</form>
@endsection