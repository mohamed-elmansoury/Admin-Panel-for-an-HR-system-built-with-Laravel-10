<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'com_code',
        'added_by',
        'updated_by',
        'active',
        'created_at',
        'updated_at'
    ];

    public function added()
    {
        return $this->belongsTo('\App\Models\Admin', 'added_by');
    }
    public function updatedby()
    {
        return $this->belongsTo('\App\Models\Admin', 'updated_by');
    }
}
