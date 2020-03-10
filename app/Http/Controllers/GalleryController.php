<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Gallery;

class GalleryController extends Controller
{
    //
    public function index(Request $request){
        $imgList = Gallery::orderBy('id', 'DESC')
                            ->simplePaginate(12);

        return view('gallery.list', ['initData'=>$request->data
                                    ,'imgList'=>$imgList]);
    }

    //view
    public function view(Request $request){

        //問い合わせを取得
        $gallery = $request->get('listNum');
        if(empty($gallery)){
            return redirect()->route('gallery');
        }

        $param=['id'=>$gallery];
        $gallery = Gallery::find($gallery);

        $info = getimagesize(asset('assets/image').'/'.$gallery->picture);
        $width = $info[0] > 500 ? 500 : $info[0];
        $height = $info[1] > 500 ? 500 : $info[1];

        return view('gallery.view', ['initData'=>$request->data
                                    ,'gallery'=>$gallery
                                    ,'width'=>$width
                                    ,'height'=>$height]);
    }

    //登録画面遷移
    public function registForm(Request $request){
        return view('gallery.regist', ['initData'=>$request->data]);
    }

    //登録
    public function regist(Request $request){
        $messages = ['title.required' => $request->data[1]['label']->gallery[0]->gallery_title_error
                    ,'image.*'=>$request->data[1]['label']->gallery[0]->gallery_image_error];
        $validateRule = Validator::make($request->all(), Gallery::$rules, $messages);

        //未選択の場合、エラー3 
        if($validateRule->fails()){
            return redirect()->route('gallery.regist')
            ->withInput()
            ->withErrors($validateRule);
        }

        //画像をアップロードする
        $imgFile = $request->files->get('image');
        $image = date('YmdHis').$imgFile->getClientOriginalName();
        move_uploaded_file($imgFile->getPathName(), public_path('assets/image')."/".$image);

        //登録処理をする
        $gallery = new Gallery;
        $gallery->title = $request->get('title');
        $gallery->picture = $image;
        $gallery->created = date('YmdHis');
        $gallery->save();

        return redirect()->route('gallery');
    }
}
