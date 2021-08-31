<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use App\Tweet;

class TweetController extends Controller
{
    //ここにrouting(web.php) で定義した関数を記述していく。
    //画面表示するための関数
    public function showTimelinePage()
    {
        $tweets = Tweet::latest()->paginate(3);

        return view('timeline', ['tweets' => $tweets]);
    }


    //Laravelではformを送信したときに[Request $request]の中に送信されるデータが格納されている。
    //登録するための関数
    public function postTweet(Request $request)  
    {
        //validate関数を作る,tweetする際のルール(バリデーション)
        $validator = $request->validate([
            'tweet' => ['required', 'string', 'max:280'],
        ]);

        //↓tweet modelを create method を使って保存 
        Tweet::create([
            'user_id' => Auth::user()->id, //user_id はカラム、Auth::user()はログインしたユーザーを表す。
            'tweet' => $request->tweet, //formの中($request)のname属性を取り出す。
        ]);

        return back();
    }


    public function destroy($id)
    {
        $tweet = Tweet::find($id); //削除したいデータをデータベースから引っ張り出してくる。
        $tweet->delete();

        return redirect()->route('timeline');
    }

}