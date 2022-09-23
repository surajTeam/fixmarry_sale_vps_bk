<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SalesTeamLeaderEmployee;
use DB;

class SalesEmployee extends Model
{
    protected $fillable = [
    	'fixmarry_employee_id', 'name', 'role_id', 'email', 'contact_number', 'date_of_birth', 'gender', 'languages_known', 'address', 'profile_photo_url', 'password'
    ];

    public function role() {
    	return $this->belongsTo(SalesRole::class);
    }

    public function salesTeamLeaderEmployee()
    {
        return $this->hasmany(SalesTeamLeaderEmployee::class,'team_leader_employee_id');
    }

    public function TLComment($userid){
        $comment = DB::table('follow_up_comments')->select('tl_comment')->where('tme_id',$userid)->get();
        $tlcomment = '';
        if(count($comment)>0) $tlcomment = $comment[0]->tl_comment;
        return $tlcomment;
    }

    public function Admincomment($tlid){
        $comment = DB::table('follow_up_comments')->select('admin_comment')->where('tl_id',$tlid)->get();
        $tlcomment = '';
        if(count($comment)>0) $tlcomment = $comment[0]->admin_comment;
        return $tlcomment;
    }
}
