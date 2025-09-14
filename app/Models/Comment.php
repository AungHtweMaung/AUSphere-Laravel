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
        'parent_comment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function socialPost()
    {
        return $this->belongsTo(SocialPost::class, 'social_post_id', 'id');
    }

    // parent comment relationship
    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    // child comments relationship
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id')->with(['user', 'replies']);
    }
}
