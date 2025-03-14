<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phones',
        'email',
        'address',
        'active',
        'com_code',
        'addedBy',
        'updatedBy',
        'created_at',
        'updated_at'
    ];

    public function added()
    {
        return  $this->belongsTo(Admin::class, 'addedBy');
    }
    public function updated_by()
    {
        return  $this->belongsTo(Admin::class, 'updatedBy');
    }
}
