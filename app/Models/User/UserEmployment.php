<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserEmployment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company',
        'organization',
        'job_position',
        'job_level',
        'employment_status',
        'branch',
        'join_date',
        'sign_date',
        'grade',
        'class',
        'approval_line',
        'approval_manager',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'id', 'user_id');
    }
}
