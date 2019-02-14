<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class News extends Model
{
    protected $fillable = ['name','description'];
    protected $hidden = ['author_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function actives(){
       $news = News::where('is_active',Config::get('CONSTANS.STATE.ACTIVE'))->orderBy('created_at')->get();
       return $news;
    }
}
