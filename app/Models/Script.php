<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Script extends Model {
    use HasFactory;
    protected $fillable = [
        'activity',
        'starttime',
        'endtime',
        'timespan',
        'location',
        'attendees',
    ];
}