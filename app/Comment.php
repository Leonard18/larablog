<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'name', 'email', 'comment', 'post_id', 'user_id', 'approved',
    ];

    public function posts() {

        return $this->belongsTo('App\Post');

    }
}
