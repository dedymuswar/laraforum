<?php

namespace App\Model;

use App\Model\Reply;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=['title', 'slug', 'body', 'category_id', 'user_id'];
    protected $with = ['replies'];
    // ini fungsi pengganti $request['slug'] = Str::slug($request->title); pada question controller
    protected static function boot()
    {
        parent::boot();
        static::creating(function($question){
            $question->slug = Str::slug($question->title);
        });
    }

    // mendefenisikan route key name tabel question adalah kolom slug
    // jadi jika request data berdasarkan slug bukan id lagi
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->latest();
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    public function getPathAttribute()
    {
        return "/question/$this->slug";
    }
}
