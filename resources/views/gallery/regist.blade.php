@extends('layouts/layout')

@section('title', 'galleryRegist')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/gallery/regist.css ')}}"/>
@endsection

@section('content')
 <form action="" method="post" enctype="multipart/form-data">
 @csrf
    <div id="title">
            <h1>{!! $initData[1]['label']->gallery[0]->gallery_submit !!}</h1>
        </div>   
    <table id="registTbl">
            <tr>
                <td>{!! $initData[1]['label']->gallery[0]->gallery_title !!}</td>
                <td>
                    <input type="text" name="title" size="35" maxlength="255" value="{{old('title')}}" />
                    @if($errors->has('title'))
                        <p class="error">{{ $errors->first('title')}}</p>
                    @endif
                </td>   
            </tr>
            <tr>
                <td>{!! $initData[1]['label']->gallery[0]->gallery_image !!}</td>
                <td>
                    <input type="file" name="image" size="35"/>
                    @if($errors->has('image'))
                        <p class="error">{{ $errors->first('image')}}</p>
                    @endif
                </td>
            </tr>
        </table>
        <div id="submitDiv"><input type="submit" value="{!! $initData[1]['label']->gallery[0]->gallery_submit !!}"/></div>
 </form> 
@endsection