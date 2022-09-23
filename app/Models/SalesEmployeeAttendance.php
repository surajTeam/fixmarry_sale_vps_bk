<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesEmployeeAttendance extends Model
{
    protected $fillable = [
    	'employee_id', 'date', 'punch_in_time'
    ];
}
