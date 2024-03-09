<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];
}
