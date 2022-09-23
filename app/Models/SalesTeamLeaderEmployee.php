<?php

namespace App\Models;
use App\Models\SalesEmployee;
use Illuminate\Database\Eloquent\Model;

class SalesTeamLeaderEmployee extends Model
{
    protected $fillable = [
    	'team_leader_employee_id', 'assigned_employee_id'
    ];

     public function salesEmployee() {
    	return $this->belongsTo(SalesEmployee::class,'assigned_employee_id');
    }
}


