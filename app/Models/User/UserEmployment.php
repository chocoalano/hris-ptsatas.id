<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    public function companyName(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Master\Company::class, 'company', 'id');
    }
    public function organizationName(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Master\Organization::class, 'organization', 'id');
    }
    public function job_positionName(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Master\JobPosition::class, 'job_position', 'id');
    }
    public function branchName(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Master\Branch::class, 'branch', 'id');
    }
    public function gradeName(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Master\Grade::class, 'grade', 'id');
    }
    public function className(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Master\ClassEmp::class, 'class', 'id');
    }
    public function approval_lineName(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approval_line', 'id');
    }
    public function approval_managerName(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approval_manager', 'id');
    }
}
