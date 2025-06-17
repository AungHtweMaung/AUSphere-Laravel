<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait NewsTrait
{
    public function scopeFilter(Builder $query) {
        if (request('searchKey')) {
            $query->where('title', 'like', '%'. request('searchKey'). '%')
                ->orWhere('content', 'like', '%' . request('searchKey') . '%');
        }
    }
}

