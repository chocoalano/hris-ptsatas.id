<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFamily extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'relationship',
        'activity',
        'age',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'id', 'user_id');
    }
}
