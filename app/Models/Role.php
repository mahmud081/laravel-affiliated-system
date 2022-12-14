<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ROLE_ADMIN = 1;
    const ROLE_GENERAL = 2;
    const ROLE_AFFILIATOR = 3;

    protected $fillable = [
        'name',
    ];
}
