<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TasksProject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'parent_id',
        'title',
        'sort',
    ];
}
