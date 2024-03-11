<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'mobile_phone',
        'phone',
        'placebirth',
        'birthdate',
        'gender',
        'bloodtype',
        'religion',
        'identity_address',
        'identity_numbers',
        'identity_expired',
        'postal_code',
        'citizen_idaddress',
        'recidential_address',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(): HasOne {
        return $this->hasOne(\App\Models\Config\Role::class, 'id', 'role_id');
    }
    public function emp(): HasOne {
        return $this->hasOne(\App\Models\User\UserEmployment::class, 'user_id', 'id');
    }
    public function empCompany(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User\UserEmployment::class, 'id', 'user_id');
    }
    public function emergency_contact(): HasOne {
        return $this->hasOne(\App\Models\User\UserEmergencyContact::class, 'user_id', 'id');
    }
    public function family(): HasMany {
        return $this->hasMany(\App\Models\User\UserFamily::class, 'user_id', 'id');
    }
    public function education(): HasMany {
        return $this->hasMany(\App\Models\User\UserEducation::class, 'user_id', 'id');
    }
    public function project_management_created(): HasMany {
        return $this->hasMany(\App\Models\Project\ProjectManagement::class, 'createdby', 'id');
    }
    public function project_management_members()
    {
        return $this->belongsToMany(\App\Models\Project\ProjectManagement::class, 'project_members');
    }
    public function project_task_created(): HasOne {
        return $this->hasOne(\App\Models\Project\ProjectTask::class, 'createdby', 'id');
    }
    public function project_task(): HasMany {
        return $this->hasMany(\App\Models\Project\ProjectTask::class, 'id', 'assignto');
    }
}
