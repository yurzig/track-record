<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TasksSection extends Model
{
    use SoftDeletes;

    public int $id;
    public string $title;
    public mixed $properties;

    protected $casts = [
        'properties' => 'json',
    ];

    protected $fillable = [
        'project_id',
        'title',
        'properties',
        'sort',
    ];

    protected $appends = ['color'];

    // Добавляем в модель поле color из поля properties
    protected function color(): Attribute
    {

        return new Attribute(
            get: fn () => sections()->getColor($this),
        );
    }


}
