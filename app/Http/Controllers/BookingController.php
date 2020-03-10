<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Nail;
use App\Booking;

class BookingController extends Controller
{
      //MENU
    public function menu(Request $request){

        //リストを取得する
        $subQuery = Nail::select('type', 'title_jp', DB::raw('MAX(title_ko) AS title_ko'), DB::raw('MAX(FORMAT(price_jp, 0)) AS price_jp'), DB::raw('MAX(FORMAT(price_ko, 0)) AS price_ko'))
                        ->groupBy(DB::raw('type, title_jp WITH ROLLUP'))->toSql();

        $nails = DB::table(DB::raw('('.$subQuery.') AS n'))
                                      ->orderBy('type','ASC')
                                      ->orderByRaw('-title_jp', 'DESC')
                                      ->orderBy('title_jp','ASC')
                                      ->get();

        return view('booking.menu', ['initData'=>$request->data
                                    ,'nails'=>$nails]);
    }

    //予約MENU
    public function booking(Request $request){
      //ログインしていない場合
      if(empty($request->data[2]['user'])){
        return redirect()->route('login');
      }

      //リストを取得する
      $subQuery = Nail::select(DB::raw('MAX(id) AS id'), 'type', 'title_jp', DB::raw('MAX(title_ko) AS title_ko'), DB::raw('MAX(FORMAT(price_jp, 0)) AS price_jp'), DB::raw('MAX(FORMAT(price_ko, 0)) AS price_ko'))
                      ->groupBy(DB::raw('type, title_jp WITH ROLLUP'))->toSql();

      $nails = DB::table(DB::raw('('.$subQuery.') AS n'))
                          ->orderBy('type','ASC')
                          ->orderByRaw('-title_jp', 'DESC')
                          ->orderBy('title_jp','ASC')
                          ->get();
   
    return view('booking.bMenu', ['initData'=>$request->data
                                  ,'nails'=>$nails]);
  }

  //予約メニュー画面チェック
  public function bookingVali(Request $request){
    //menu選択チェック
    $rules=['nailMenu' => 'required',];
    $messages=['nailMenu.required' => $request->data[1]['label']->booking[0]->booking_sel_error,];
    $validateRule=Validator::make($request->all(), $rules, $messages);

    //未選択の場合、エラー
    if($validateRule->fails()){
      return redirect()->route('booking')
      ->withInput()
      ->withErrors($validateRule);
     }

     $selMenus=$request->get('nailMenu');

    //予約MENU->date選択
    return redirect()->route('booking.date')->with(['initData'=>$request->data
                                  ,'nailMenu'=>$selMenus]);
  }

  //予約MENU->date選択
  public function bDate(Request $request){
      //ログインしていない場合
      if(empty($request->data[2]['user'])){
        return redirect()->route('login');
      }
      //選択メニュー
      $selMenus=$request->session()->get('nailMenu');
      if(empty($selMenus)){
          $selMenus=$request->get('nailMenu');
      }
      if(empty($selMenus)){
        return redirect()->route("booking");
      }

    //今週
    $rWeek = $request->get('week');
    if(empty($rWeek)){
      $rWeek=0;
    }

    if($rWeek < 0 ){
      $rWeek = 0;
    }else if($rWeek > 4){
      $rWeek = 4;
    }
    
    //基準日
    $today = date("m/d");
    $nowTime = date("H:i");
 
    $bookings= Booking::select('reservation')
                        ->where('status', '<>', '9')
                        ->whereDate('reservation', '>' , NOW())
                        ->orderBy('reservation')->get();

    //日付選択画面遷移、
    return view("booking.bDateSelect",['initData'=>$request->data,
                                        'startDay'=>$rWeek,
                                        'today'=>$today,
                                        'nowTime'=>$nowTime,
                                        'bookings'=>$bookings,
                                        'nailMenu'=>$selMenus]);
  }

  //時間選択後
  public function bConfirm(Request $request){
    //ログインしていない場合
    if(empty($request->data[2]['user'])){
      return redirect()->route('login');
    }

    //選択メニュー
    $selMenus = $request->get('nailMenu');
    $selDate = $request->get('selDate');
    $selTime = $request->get('selTime');
    if(empty($selMenus) || empty($selDate) || empty($selTime)){
        return redirect()->route('booking');
    }

    $nails = Nail::select('type', DB::raw('MAX(title_jp) AS title_jp'), DB::raw('MAX(title_ko) AS title_ko'), DB::raw('FORMAT(SUM(price_jp), 0) AS price_jp'), DB::raw('FORMAT(SUM(price_ko), 0) AS price_ko'), DB::raw('SEC_TO_TIME(sum(TIME_TO_SEC( useTime ))) AS useTime'))
                            ->whereIn('id', [implode(',',$selMenus)])
                            ->groupBy(DB::raw('type WITH ROLLUP'))
                            ->get();

    return view('booking.bConfirm',['initData'=>$request->data,
                                  'selDate'=>$selDate,
                                  'selTime'=>$selTime,
                                  'nailMenu'=>$selMenus,
                                  'nails'=>$nails]);
  }

  //予約登録
  public function bComplete(Request $request){
     //ログインしていない場合
     if(empty($request->data[2]['user'])){
      return redirect()->route('login');
    }

    //予約登録
    $selMenus = $request->get('nailMenu');
    $selDate = $request->get('selDate');
    $selTime = $request->get('selTime');

    if(empty($selMenus) || empty($selDate) || empty($selTime)){
      return redirect()->route('booking');
    }
    
    //登録処理をする
    foreach($selMenus as $selMenu) {
      $booking = new Booking;
      $booking->member_id = $request->data[2]['user']->id;
      $booking->nail_id = $selMenu;
      $booking->created = date('Y-m-d');
      $booking->reservation = date("Y")."/".$selDate." ".$selTime.":00";
      $booking->status = "1";
      $booking->save();
    }

    return view('booking.bComplete', ['initData'=>$request->data]);
  }

  //予約確認
  public function bConfirmList(Request $request){
    //ログインしていない場合
    if(empty($request->data[2]['user'])){
      return redirect()->route('login');
    }

       $subQuery = DB::table('bookings')
              ->join('nails', 'nails.id' , '=', 'bookings.nail_id')
              ->select('bookings.reservation', 'nails.type','bookings.member_id' , DB::raw('MAX(nails.title_jp) as title_jp'), DB::raw('MAX(nails.title_ko) as title_ko'), DB::raw('MAX(bookings.status) as status'))
              ->groupBy(DB::raw('bookings.member_id, bookings.reservation, nails.type WITH ROLLUP'))
              ->toSql();
    
    $dates = DB::table(DB::raw('('.$subQuery.') AS a'))
              ->where('member_id', '=' , $request->data[2]['user']->id)
              ->orderBy('reservation','DESC')
              ->orderByRaw('-type', 'DESC')
              ->orderBy('title_jp','ASC')
              ->get();
              
    return view('booking.bConfirmList',['initData'=>$request->data,
                                        'dates'=>$dates]);
  }
}
