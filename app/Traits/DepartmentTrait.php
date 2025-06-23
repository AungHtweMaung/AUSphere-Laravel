<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait DepartmentTrait
{
    public function scopeFilter(Builder $query) {
        if (request('searchKey')) {
            $query->where(function($q) {
                $q->where('title_short_term', 'like', '%'. request('searchKey'). '%')
                ->orwhere('title', 'like', '%'. request('searchKey'). '%');
            });
        }

        if (request('search_department_type_id')) {
            $query->whereHas('department_type', function($q) {
                $q->where('id', request('search_department_type_id'));
            });
        }
    }
}

