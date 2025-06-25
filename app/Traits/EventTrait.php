<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait EventTrait
{
    public function scopeFilter(Builder $query) {
        if (request('searchTitle')) {
            $query->where('title', 'like', '%'. request('searchTitle'). '%');
        }

        if (request('searchStartDate') && request('searchEndDate')) {
            $query->whereDate('created_at', '>=', request('searchStartDate'))
                ->whereDate('created_at', '<=', request('searchEndDate'));
        } elseif (request('searchStartDate')) {
            $query->whereDate('created_at', '>=', request('searchStartDate'));
        } elseif (request('searchEndDate')) {
            $query->whereDate('created_at', '<=', request('searchEndDate'));
        }

    }
}

