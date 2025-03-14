<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        
        'photo',
        'resume',
        
        'resignation_id',
        'religion_id',
        'qualification_id',
        'occasion_id',
        'nationality_id',
        'branch_id',
        'admin_id',
        
    ];

   

    public function resignation()
    {
        return $this->belongsTo(Resignation::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    public function occasion()
    {
        return $this->belongsTo(Occasions::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branche::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    
}
