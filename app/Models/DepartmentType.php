<?php

namespace App\Models;
use App\Traits\DepartmentTypeTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;



class DepartmentType extends Model
{
    use HasFactory, SoftDeletes, DepartmentTypeTrait;

    protected $fillable = ['name'];

    public function departments()
    {
        return $this->hasMany(Department::class, 'department_type_id', 'id');
    }

}
