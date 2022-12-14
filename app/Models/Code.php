<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $fillable = [
        'gen_code',
        'user_registered'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
