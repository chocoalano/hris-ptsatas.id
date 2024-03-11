<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectTask extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_management_id',
        'createdby',
        'assignto',
        'description',
        'progress',
        'start_date',
        'due_date',
    ];
    public function createdByUser(): BelongsTo {
        return $this->belongsTo(\App\Models\User::class, 'createdby', 'id');
    }
    public function asign(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'assignto', 'id');
    }
    public function project(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Project\ProjectManagement::class, 'project_management_id', 'id');
    }
}
