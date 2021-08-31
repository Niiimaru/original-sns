<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //親要素なら単数形、子要素なら複数形。 

    public function user()  //Like model から見てuser model は「親」
    {
        return $this->belongsTo('App\Users');  //Like modelの親はuser modelだということを言ってあげる。
    }

    public function tweet()  //Like model から見てtweet model は「親」
    {
        return $this->belongsTo('App\Tweet');  //Like modelの親はtweet model だということを言ってあげる。
    }

}
