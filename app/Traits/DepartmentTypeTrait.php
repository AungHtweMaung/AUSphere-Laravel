<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait DepartmentTypeTrait
{
    public function scopeFilter(Builder $query) {
        if (request('searchKey')) {
            $query->where('name', 'like', '%'. request('searchKey'). '%');
        }
    }
}

