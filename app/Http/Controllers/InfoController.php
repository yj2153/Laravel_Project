<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    //
    public function index(Request $request){
        return view('info.info', ['initData'=>$request->data]);
    }

    public function map(Request $request){
        return view('info.map', ['initData'=>$request->data]);
    }
}
  