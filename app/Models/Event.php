<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EventTrait;

class Event extends Model
{
    use HasFactory, SoftDeletes, EventTrait;

    protected $guarded = [];
}
