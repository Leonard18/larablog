<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['category_name'];

    public function posts() {

        return $this->hasMany('App\Post');

    }
}


