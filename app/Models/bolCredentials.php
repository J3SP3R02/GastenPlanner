<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bolCredentials extends Model
{
    use HasFactory;

    protected $fillable = [
        'access_token',
        'token_type',
        'expire_date',
        'scope',
    ];
}
