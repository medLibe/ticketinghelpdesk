<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_name',
        'activity_path',
        'activity_behavior',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
