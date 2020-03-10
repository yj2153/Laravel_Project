<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Inquire;

class InquireController extends Controller
{
    //
    public function index(Request $request){
       
        $inquireList = Inquire::where('reply_id', null)
                                ->orderBy('id', 'DESC')
                                ->simplePaginate(5);
        
        return view('inquire.list', ['initData'=>$request->data
                                    ,'inquireList'=>$inquireList]);
    }

    //リスト内容確認
    public function view(Request $request){
        //選択されたリスト番号
        $listNum = $request->get('listNum');
        if(empty($listNum)){
            return redirect()->route('inquire');
        }

        //問い合わせを取得
        $inquire = Inquire::find($listNum);

        //コメント取得
        $comments = Inquire::where('reply_id', $listNum)->get();
        return view('inquire.view', ['initData'=>$request->data
                                    ,'inquire'=>$inquire
                                    ,'comments'=>$comments
                                    ,'listNum'=>$listNum]);
    }

    //投稿を記録する
    public function commentRegist(Request $request){
        
        $message = $request->get('message');
        $listNum = $request->get('listNum');

        if(!empty($message)){
            $inquire = new Inquire;
            $inquire->member_id = $request->data[2]['user']->id;
            $inquire->message = $message;
            $inquire->reply_id = $listNum;
            $inquire->created = date("Y-m-d");
            $inquire->save();
        }

        return redirect(route('inquire.view').'?listNum='.$listNum);
    }

    //コメントを削除する
    public function commentDelete(Request $request){
        $replyID = $request->get('reply_id');
        $listNum = $request->get('listNum');

        if(!empty($replyID) && !empty($listNum)){
            $param=['reply_id'=>$replyID];
            Inquire::find($reply_id);
        }

        return redirect(route('inquire.view').'?listNum='.$listNum);
    }

    //登録フォームを表示
    public function registView(Request $request){
        
        //ログインしていない場合
        if(empty($request->data[2]['user'])){
            return redirect()->route('login');
        }

        //問い合わせを取得
        $listNum = $request->get('listNum');
        if(!empty($listNum)){
            $inquire = Inquire::find($listNum);
    
            return view('inquire.regist', ['initData'=>$request->data
                                            ,'inquire'=>$inquire]);
        }

        return view('inquire.regist', ['initData'=>$request->data]);
    }

    //登録する
    public function regist(Request $request){
         //入力チェック
        $messages = ['title.required' => $request->data[1]['label']->inquire[0]->inquire_error_title
                    ,'message.required' => $request->data[1]['label']->inquire[0]->inquire_error_msg];
        $validateRule = Validator::make($request->all(), Inquire::$rules, $messages);

        if($validateRule->fails()){
            return redirect()->back()
            ->withInput()
            ->withErrors($validateRule);
        }

        //問い合わせを記録する
        $title = $request->get('title');
        $msg = $request->get('message');
        $listNum = $request->get('listNum');
        
        if(!empty($msg) && empty($listNum)){
            //新規
            $inquire = new Inquire;
            $inquire->member_id=$request->data[2]['user']->id;
            $inquire->title=$title;
            $inquire->message=$msg;
            $inquire->created=date("Y-m-d H:i:s");
            $inquire->save();

        }else if(!empty($msg) && !empty($listNum)){
            //更新
            $inquire = Inquire::find($listNum);
            $inquire->member_id=$request->data[2]['user']->id;
            $inquire->title=$title;
            $inquire->message=$msg;
            $inquire->created=date("Y-m-d H:i:s");
            $inquire->save();
        }

        return redirect()->route('inquire');
    }
}
