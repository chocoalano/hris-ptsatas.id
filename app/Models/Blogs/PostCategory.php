<?php

namespace App\Models\Blogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostCategory extends Model
{
    use HasFactory;
    protected $fillable = ["name"];
    public function post(): HasOne {
        return $this->hasOne(\App\Models\Blogs\Post::class, 'id', 'category_id');
    }
}
