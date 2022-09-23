<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mothertongue extends Model
{
   protected $table = 'mothertongue';
   protected $fillable = [
    	'mtongue_id ', 'mtongue_name', 'status'
    ];
}
