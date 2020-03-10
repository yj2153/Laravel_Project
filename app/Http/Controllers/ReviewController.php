<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;

class ReviewController extends Controller
{
    //投稿を取得する
    public function index(Request $request){
        $test = Post::find('16')->replys()->get();

        //最終ページを取得する
        $posts = Post::where('reply_posts_id', '=' , '0')
                                ->orderBy('created', 'DESC')
                                ->simplePaginate(5);

        //返信の場合
        $res=$request->get('res');
        $message="";
        if(!empty($res)){
            $param=['res'=>$res];
            $response = DB::SELECT('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=:res ORDER BY p.created DESC', $param);
            $message = '@'.$response[0]->name.' '.$response[0]->message;
        }

        return view('review.review', ['initData'=>$request->data
                                    ,'posts'=>$posts
                                    ,'res'=>$res
                                    ,'message'=>$message]);
    }

    //投稿を記録する
    public function insert(Request $request){
        $message = $request->get('message');
        if(!empty($message)){
            $replyID=$request->get('reply_post_id');
            if(empty($replyID)){
                $replyID="0";
            }

            $post = new Post;
            $post->member_id = $request->data[2]['user']->id;
            $post->message = $message;
            $post->reply_posts_id=$replyID;
            $post->created=date('YmdHis');
            $post->save();
        }

        return redirect()->route('review');
    }

    //投稿を削除する
    public function delete(Request $request){
        $user=$request->data[2]['user'];
        if(!empty($user)){
            $message = Post::find($request->get('id'));
    
            //削除する
            if(!strcmp($message->member_id, $user->id) && strcmp($message->reply_posts_id, '0')){
                Post::find($request->get('id'))->delete();
                DB::table('posts')
                ->where('reply_posts_id', '=', $request->get('id'))
                ->delete();
            }else if(!strcmp($message->member_id, $user->id) && !strcmp($message->reply_posts_id, '0')){
                Post::find($request->get('id'))->delete();
            }
        }
    
        return redirect()->route('review');
    }
}
