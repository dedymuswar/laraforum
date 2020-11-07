<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable=['body','question_id','user_id'];

    public function question()
    {
        return $this->belongsTo('App\Model\Question');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function like()
    {
        return $this->hasMany('App\Model\Like');
    }
}
