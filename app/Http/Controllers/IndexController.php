<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(Request $request){
        $msgData=[
            'msg'=>'これはコントローラから渡されたメッセージです。',
        ];
        return view('index', ['initData'=>$request->data]);
    }

    //表示言語切り替え
    public function changeLang(Request $request){
        $lang = $request->lang;
        $request->session()->put('lang', $lang);
        return redirect('/index');
    }
}
