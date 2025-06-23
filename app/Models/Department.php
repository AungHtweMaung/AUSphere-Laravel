<?php

namespace App\Models;

use App\Traits\DepartmentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, DepartmentTrait;

    protected $fillable = ['department_type_id', 'title_short_term', 'title', 'content', 'image'];

    public function department_type()
    {
        return $this->belongsTo(DepartmentType::class, 'department_type_id', 'id');
    }

}
