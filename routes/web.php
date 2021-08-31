<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//user が /timeline と入力した際に TweetController を動かして、showTimeline 関数を動かす。
Route::get('/timeline', 'TweetController@showTimelinePage')->name('timeline');

Route::post('/timeline', 'TweetController@postTweet');

//'/timeline/delete/{id}' このルートを destroy と名付けたことで、timeline.blade.php の削除機能を呼び起こす
//{id} には [$tweet->id] が格納されている。
Route::post('/timeline/delete/{id}', 'TweetController@destroy')->name('destroy');

//引数にidを渡し、UserController かつ show関数を動かす。このURLを show と名づける。
Route::get('/user/show/{id}', 'UserController@show')->name('show');

//いいねを作成するためのルーティング
Route::get('/tweets/{tweet_id}/likes', 'LikeController@store');
//いいねを取り消すためのルーティング
Route::get('/likes/{like_id}', 'LikeController@destroy');