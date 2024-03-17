<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'createdby',
        'fullname',
        'address',
        'company',
        'type',
        'phone',
        'email',
    ];
    public function userCreated(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'createdby', 'id');
    }
}
