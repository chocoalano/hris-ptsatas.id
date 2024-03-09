<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProjectMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'project_management_id',
    ];
}
