<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectManagement extends Model
{
    use HasFactory;
    protected $fillable = [
        'createdby',
        'name',
        'overview',
        'budget',
        'start_date',
        'due_date',
        'progress',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'id', 'createdby');
    }
    public function members()
    {
        return $this->belongsToMany(\App\Models\User::class, 'project_members');
    }
    public function task(): HasMany {
        return $this->hasMany(\App\Models\Project\ProjectTask::class, 'project_management_id', 'id');
    }
}
