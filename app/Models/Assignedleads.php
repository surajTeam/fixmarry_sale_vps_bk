<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SalesEmployee;
class Assignedleads extends Model
{
    protected $table = 'assigned_leads';
  
     public function teamlead() {
    	return $this->belongsTo(SalesEmployee::Class,'tl_id');
    }

     public function register() {
    	return $this->belongsTo(register::Class,'lead_id','index_id');
    }
}

