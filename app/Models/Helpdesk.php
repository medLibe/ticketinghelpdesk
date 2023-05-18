<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helpdesk extends Model
{
    use HasFactory;

    protected $fillable = [
        'helpdesk_name',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
