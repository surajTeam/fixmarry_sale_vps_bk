<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
   protected $fillable = [
    	'first_name', 'last_name', 'email', 'contact_number', 'gender', 'date_of_birth', 'marital_status', 'no_of_child', 'religion', 'caste', 'mother_tongue', 'country', 'state', 'city', 'address'
    ];
}
