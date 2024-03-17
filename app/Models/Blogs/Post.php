<?php

namespace App\Models\Blogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $casts = [
        'tags' => 'array',
    ];
    protected $fillable = [
        "createdby",
        "category_id",
        "title",
        "slug",
        "keywords",
        "description",
        "content",
        "cover_image",
        "tags"
    ];
    public function category(): BelongsTo {
        return $this->belongsTo(\App\Models\Blogs\PostCategory::class, 'category_id', 'id');
    }
}
