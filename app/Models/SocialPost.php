<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class SocialPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'social_post_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'social_post_id', 'id')->with('replies');
    }

    public function images()
    {
        return $this->hasMany(SocialPostImage::class, 'social_post_id', 'id');
    }
}
