<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'name',
        'address',
        'latitude',
        'longitude',
    ];
    public function company(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Master\Company::class, 'company_id', 'id');
    }
}
