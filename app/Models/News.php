<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\NewsTrait;

class News extends Model
{
    use HasFactory, SoftDeletes, NewsTrait;

    protected $fillable = ['user_id', 'title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function newsContents()
    {
        return $this->hasMany(NewsContent::class, 'news_id', 'id');
    }
}
