<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use App\Like;

class LikeController extends Controller
{
    //保存処理
    public function store(Request $request)
    {
        $like = new Like(); //Like model を宣言
        $like->tweet_id = $request->tweet_id; //$like は like tableを表す。
        $like->user_id = Auth::user()->id; //ログイン中のuser_id
        $like->save();

        return redirect('/timeline');
    }

    public function destroy(Request $request)
    {
        $like = Like::find($request->like_id); //like tableにアクセスして$requestで送られてきた中からlike_idを引っ張り出す。
        $like->delete();
        
        return redirect('/timeline');
    }

}
