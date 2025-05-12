<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $casts = [
        'in_work' => 'boolean',
    ];

    protected $fillable = [
        'project_id',
        'section_id',
        'parent_id',
        'title',
        'description',
        'date_start',
        'date_end',
        'in_work',
        'type',
        'comments',
        'hide_until',
        'sort',
    ];
}
