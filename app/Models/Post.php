<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\Exercise;


class Post extends Model
{
    use HasFactory;

    public function user()
{
    return $this->belongsTo(User::class);
}

public function exercise()
{
    return $this->belongsTo(Exercise::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}


protected $fillable = [ //「fillable」を設定して保存出来るように！！
    'title',
    'description',
    'user_id',
    'exercise_id',
];
}
