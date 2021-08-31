<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    //user_id, tweet が保存されるための処理
    protected $fillable = [
        'user_id', 'tweet',
    ];

    //'App\~'はmodel を表す。 親要素なら単数形、子要素なら複数形。 

    public function user()  //Tweetテーブルから見てusersテーブルは「親」
    {
        return $this->belongsTo('App\User');  //Tweew modelの親はusersテーブルだということを言ってあげる。
    }


    public function likes()
    {
        return $this->hasMany('App\Like'); //Tweet model に対してlike model はたくさんある。
    }

    public function likedBy($user) //$userにはtimeline.blade.php内のAuth::user（ログイン中のユーザー）が運ばれてくる。
    {
        // Like::where Likeテーブルにアクセス
        // $user->id ログイン中のユーザーのidで
        // user_id を検索する
        //かつ$this->id で tweet_id でも検索をかける
        //このツイートでログイン中のユーザーがLikeテーブルにLikeを持っているのかを調べている。
        return Like::where('user_id', $user->id)->where('tweet_id', $this->id); //
    }

}
