<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    // 投稿（posts）とのリレーション：1つの種目は複数の投稿を持つ
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // ユーザーとのリレーション：1つの種目は1人のユーザーに属する
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
