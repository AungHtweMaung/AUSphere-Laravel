<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'social_posts_comments';

    protected $fillable = [
        'user_id',
        'social_post_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function socialPost()
    {
        return $this->belongsTo(SocialPost::class, 'social_post_id', 'id');
    }
}
