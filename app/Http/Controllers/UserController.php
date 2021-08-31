<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function show($id)
    {
        $user = User::find($id); //Userにアクセスして、Findメソッドで取得。$idで検索をかける
        
        return view('profile', ['user'=> $user]); //取得したデータを運ぶ処理。profile.blade.phpに運ぶ。userキーを指定して、値はuserであることを記述。
    }
}
