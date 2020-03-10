<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//初期
Route::name('index')->get('index', 'IndexController@index');
Route::get('index/{lang?}', 'IndexController@changeLang');

//INFO
Route::name('info')->get('info', 'InfoController@index');
Route::name('info.map')->get('map', 'InfoController@map');
Route::name('menu')->get('menu', 'BookingController@menu');

//予約
Route::name('booking')->get('booking', 'BookingController@booking');
Route::post('booking', 'BookingController@bookingVali');
Route::name('booking.date')->get('booking/date', 'BookingController@bDate');
Route::name('booking.date')->post('booking/date', 'BookingController@bDate');
Route::get('booking/confirm', function () {
    return redirect()->route('booking');
});
Route::name('booking.confirm')->post('booking/confirm', 'BookingController@bConfirm');
Route::name('booking.complete')->post('booking/complete', 'BookingController@bComplete');
Route::get('booking/complete', function () {
    return redirect()->route('booking');
});
Route::name('booking.confirmList')->get('booking/confirmList', 'BookingController@bConfirmList');

//Gallery
Route::name('gallery')->get('gallery', 'GalleryController@index');
Route::name('gallery.view')->get('gallery/view', 'GalleryController@view');
Route::name('gallery.regist')->get('gallery/regist', 'GalleryController@registForm');
Route::post('gallery/regist', 'GalleryController@regist');

//Inquire
Route::name('inquire')->get('inquire', 'InquireController@index');
Route::name('inquire.view')->get('inquire/view', 'InquireController@view');
Route::POST('inquire/view', 'InquireController@commentRegist');
Route::name('inquire.view.cDelete')->get('inquire/view/CommentDelete', 'InquireController@commentDelete');
Route::name('inquire.regist')->get('inquire/regist', 'InquireController@registView');
Route::post('inquire/regist', 'InquireController@regist');

//review
Route::name('review')->get('review', 'ReviewController@index');
Route::post('review', 'ReviewController@insert');
Route::name('review.delete')->get('review/delete', 'ReviewController@delete');

//ログイン
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
