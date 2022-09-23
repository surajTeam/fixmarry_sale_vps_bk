<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Assignedleads;
class register extends Model
{
	protected $table = 'register';
   protected $fillable = [
    	'firstname', 'lastname', 'email','mobile_code','mobile', 'gender', 'birthdate', 'm_status', 'tot_children', 'religion', 'caste', 'm_tongue', 'country_id', 'state_id', 'city', 'address'
    ];

     public function assinedlead()
    {
        return $this->hasMany(Assignedleads::Class,'lead_id','index_id');
    }
    
}
