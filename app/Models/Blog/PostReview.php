<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostReview extends Model
{
    use SoftDeletes;

    public int $id;
    public mixed $post;

    protected $fillable = [
        'post_id',
        'user_id',
        'rating',
        'comment',
        'response',
        'status',
        'editor'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

}
