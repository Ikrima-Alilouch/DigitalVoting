<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = [
        'logo',
        'name',
        'description',
        'seats',
        'status',
        'created_at',
        'updated_at',
    ];
}
