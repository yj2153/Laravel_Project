@extends('layouts/layout')

@section('title', 'Index')

@section('content')
    <p>{{$initData[1]['label']->title[0]->title}}</p>
@endsection
