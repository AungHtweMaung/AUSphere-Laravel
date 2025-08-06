<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialPostImage extends Model
{
    use HasFactory;

    protected $fillable = ['social_post_id', 'image'];

    public function socialPost()
    {
        return $this->belongsTo(SocialPost::class, 'social_post_id', 'id');
    }
}
