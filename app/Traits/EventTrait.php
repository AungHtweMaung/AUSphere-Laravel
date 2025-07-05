<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait EventTrait
{
    public function scopeFilter(Builder $query) {

        if (request('searchTitle')) {
            $query->where('title', 'like', '%'. request('searchTitle'). '%');
        }

        if (request('searchStartDate') && request('searchEndDate')) {
            // Both are in "F Y" format, e.g., "May 2025"
            $start = Carbon::createFromFormat('F Y', request('searchStartDate'))->startOfMonth();
            $end = Carbon::createFromFormat('F Y', request('searchEndDate'))->endOfMonth();
            $query->whereDate('date', '>=', $start)
            ->whereDate('date', '<=', $end);
        } elseif (request('searchStartDate')) {
            // Single month/year filter
            $date = Carbon::createFromFormat('F Y', request('searchStartDate'));
            $query->whereMonth('date', $date->month)
                  ->whereYear('date', $date->year);
        } elseif (request('searchEndDate')) {
            $date = Carbon::createFromFormat('F Y', request('searchEndDate'));
            $query->whereMonth('date', $date->month)
                  ->whereYear('date', $date->year);
        }

    }
}

