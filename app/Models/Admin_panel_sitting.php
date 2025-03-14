<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_panel_sitting extends Model
{
    use HasFactory;

    protected $fillable = [

        'company_name',
        'system_status',
        'image',
        'phones',
        'address',
        'email',
        'added_by',
        'updated_by',
        'com_code',
        'after_minute_calculate_delay',
        'after_minute_calculate_early_departure',
        'after_minute_quarterday',
        'after_time_half_deduct',
        'after_time_allday_deduct',
        'monthly_vacation_balance',
        'after_days_begin_vacation',
        'first_balance_begin_vacation',
        'sanctions_value_first_absence',
        'sanctions_value_second_absence',
        'sanctions_value_third_absence',
        'sanctions_value_forth_absence',
        'created_at',
        'updated_at'
    ];
}
