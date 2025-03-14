<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shifts_type extends Model
{
    use HasFactory;
    protected $table = 'shifts_types'; // Specify the table name

    protected $fillable = [
        'type',
        'from_time',
        'to_time',
        'total_hour',
        'added_by',
        'updated_by',
        'com_code',
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
