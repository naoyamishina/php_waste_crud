<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'image',
        'money'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function nices() {
        return $this->hasMany(Nice::class);
    }

    //いいねされているかを判定するメソッド。
    public function isNicedBy($user): bool {
        return Nice::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
}
