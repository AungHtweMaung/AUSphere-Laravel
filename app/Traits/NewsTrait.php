<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait NewsTrait
{
    public function scopeFilter(Builder $query) {
        if (request('searchKey')) {
            $query->where('title', 'like', '%'. request('searchKey'). '%')
                ->orWhereHas('newsContents', function ($q) {
                    $q->where('content', 'like', '%'. request('searchKey'). '%');
                });
        }
    }
}

