<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Model\Category');
    }

    public function tags(){
        $this->belongsToMany('App\Model\Tag');
    }
}
