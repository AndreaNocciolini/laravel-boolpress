<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at',
    ];

    public function post(){
        return $this->hasMany('App\Model\Post');
    }
}
