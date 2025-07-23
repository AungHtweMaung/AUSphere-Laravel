<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // set table name when model name and table name are different
    protected $table = 'social_posts_likes';

    protected $fillable = [
        'user_id',
        'social_post_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
