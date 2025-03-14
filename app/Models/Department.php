<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table='department';

    protected $fillable = [
        'name',
        'phone',
        'added_by',
        'updated_by',
        'notes',
        'com_code',
        'active',
        'created_at',
        'updated_at'
    ];
    
}
