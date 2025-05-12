<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskProject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'parent_id',
        'title',
        'sort',
    ];
}
