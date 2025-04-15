<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TasksSection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'title',
        'properties',
        'sort',
    ];
}
