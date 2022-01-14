<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Topic extends Model
{
    use Rateable;

    protected $fillable = ['title', 'body', 'views', 'category_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
