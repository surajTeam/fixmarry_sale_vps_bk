<?php

namespace App\Http\Controllers\TeamLeader;

use App\Http\Controllers\Controller;
use App\Models\SalesEmployee;
use App\Models\SalesRole;
use App\Models\Lead;
use App\Models\SalesTeamLeaderEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\register;
use DB;
use stdClass;

class TMEManagementController extends Controller
{
    public function tmeListPage() {
    	$userId = Session::get('sales_employee_id');
    	
    	 // $role_id = SalesRole::where('name', 'telemarketing_executive')->first()['id'];
    	 // dd($role_id);
    	// $role_id = SalesTeamLeaderEmployee::where('team_leader_employee_id', $userId)->get();
//dd($role_id['0']['assigned_employee_id']);
    	//dd($role_id);

    	$tme = SalesEmployee::where('id', $userId)->first();
    	//return $tme;
    	// return $tme->salesTeamLeaderEmployee;
    	return view('team_leader.list_tme', compact('tme'));
    }

     public function assignLeadForm() {
         $userId = Session::get('sales_employee_id');
       
        $team_leaders = SalesEmployee::where('id', $userId)->first();
         // \DB::enableQueryLog();
       
       $leads = $leads = register::join('assigned_leads','assigned_leads.lead_id','register.index_id')->where('assigned_leads.tl_id',$userId )
			->where(function ($query){
			$query->whereNull('assigned_leads.tme_id')
			->Orwhere('assigned_leads.tme_id', '=', '');
		})->get();
        // dd(\DB::getQueryLog());
        return view('team_leader.lead_assign_form', compact('team_leaders', 'leads'));
    }


    public function assignLead(Request $request) {
        $request->validate([
            'team_leader' => 'required',
            'tme' => 'required|array|min:1'
        ]);

        for ($i=0; $i < count($request->tme); $i++) { 
            // Lead::update([
            //     'tl_id' => $request->team_leader
            //     //'tme_id' => $request->tme[$i]
            // ]);
            if($request->owner=='admin'){
                $assignlead['lead_id'] = $request->tme[$i];
                $assignlead['tl_id']   = $request->team_leader;
                DB::table('assigned_leads')->insert($assignlead);
                return redirect('admin/team-leader/assign-lead')->with('success', 'Lead Assigned Successfully');
            }else{
                DB::table('assigned_leads')->where('lead_id',$request->tme[$i])->update(['tme_id'=>$request->team_leader]);
                return redirect('team-leader/tme/assign-lead')->with('success', 'Lead Assigned Successfully');
            }
        }
        
        //return true;
        
    }
	
	public function leadsList(){
        $userId = Session::get('sales_employee_id');
    	$leadlist = register::join('assigned_leads','assigned_leads.lead_id','register.index_id')->where('assigned_leads.tl_id', $userId)->get();
        return view('team_leader.leads_list',['leadlist'=>$leadlist]);
    }
    public function LeadsComment($cmtid){
        $lead_list = register::join('assigned_leads','assigned_leads.lead_id','register.index_id')->where('assigned_leads.lead_id', $cmtid)->get();
        $html = '';
        $html.='<table class="table table-bordered custom-table" id="employeeList" data-ordering="false">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Created On</th>
                            <th>Status</th>
                            <th>Comment</th>
                            
                        </tr>
                    </thead>';
            if(count($lead_list)>0){
                foreach($lead_list as $leads){
                    $html.='<tr>
                            <td>'.$leads->created_at.'</td>
                            <td>'.$leads->status.'</td>
                            <td>'.$leads->comment.'</td>
                        </tr>';
                }
            }else{
                $html.='<tr>
                            <td colspan="6" style="text-align:center;">No data Found</td>
                        </tr>';
            }
        $html.='</table>';
        return $html;
    }
    public function TMELeadsComment($tmeid){
        //dd($tmeid);
        $lead_list = register::join('assigned_leads','assigned_leads.lead_id','register.index_id')->where('assigned_leads.tl_id', $tmeid)->get();
        dd($lead_list);
        $html = '';
        $html.='<table class="table table-bordered custom-table" id="employeeList" data-ordering="false">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Created On</th>
                            <th>Status</th>
                            <th>Comment</th>
                            
                        </tr>
                    </thead>';
            if(count($lead_list)>0){
                foreach($lead_list as $leads){
                    $html.='<tr>
                            <td>'.$leads->created_at.'</td>
                            <td>'.$leads->status.'</td>
                            <td>'.$leads->comment.'</td>
                        </tr>';
                }
            }else{
                $html.='<tr>
                            <td colspan="6" style="text-align:center;">No data Found</td>
                        </tr>';
            }
        $html.='</table>';
        return $html;
    }

    public function TMEleadsList($tmeid){
        $lead_list = register::join('assigned_leads','assigned_leads.lead_id','register.index_id')->where('assigned_leads.tme_id', $tmeid)->get();
        dd($lead_list);
        $html = '';
        $html.='<table class="table table-bordered custom-table" id="employeeList" data-ordering="false">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Contact Number</th>
                            <th>Status</th>
                            <th>Comment</th>
                        </tr>
                    </thead>';
            if(count($lead_list)>0){
                foreach($lead_list as $leads){
                    $html.='<tr>
                            <td>'.$leads->firstname.'</td>
                            <td>'.$leads->email.'</td>
                            <td>'.$leads->birthdate.'</td>
                            <td>'.$leads->mobile.'</td>
                            <td>';
                            if($leads->status=='free'){
                                $leads->status = 'Free User';
                            }elseif($leads->status=='followup'){
                                $leads->status = 'Follow Up';
                            }else{
                                $leads->status = 'Paid User';
                            }
                    $html.=$leads->status.'</td>
                            <td>'.$leads->comment.'</td>
                        </tr>';
                }
            }else{
                $html.='<tr>
                            <td colspan="6" style="text-align:center;">No data Found</td>
                        </tr>';
            }
        $html.='</table>';
        return $html;
    }

    public function TMEParticularleadsList(){
        $userId = Session::get('sales_employee_id');
        $leadlist = register::join('assigned_leads','assigned_leads.lead_id','register.index_id')->where('assigned_leads.tme_id', $userId)->get();
        return view('tme.leads_list',['leadlist'=>$leadlist]);
    }

    public function Editlead($id){
        $lead_value = register::join('assigned_leads','assigned_leads.lead_id','register.index_id')->select('register.firstname','register.email','register.mobile','register.matri_id','register.index_id','assigned_leads.status','assigned_leads.comment')->where('index_id',$id)->first();
        return view('tme.leads_edit',['leadsvalue'=>$lead_value]);
    }

    public function UpdateLead(Request $request){
         $userId = Session::get('sales_employee_id');
        //dd($userId);
        // DB::table('assigned_leads')->where('lead_id',$request->lead_id)->update(['status'=>$request->status,'comment'=>$request->comment]);
        $assignlead['lead_id'] = $request->lead_id;
                $assignlead['status']   = $request->status;
                $assignlead['comment']   = $request->comment;
                $assignlead['created_at']  = now();
                DB::table('assigned_leads')->insert($assignlead);
        return redirect('team-leader/tme/tme-lead-list');
    }

    public function EditTME($tmeid){
        $tme = SalesEmployee::Leftjoin('follow_up_comments','follow_up_comments.tme_id','sales_employees.id')->select('sales_employees.id','sales_employees.name','sales_employees.email','sales_employees.contact_number','sales_employees.fixmarry_employee_id','follow_up_comments.tl_comment')->where('sales_employees.id',$tmeid)->first();
        return view('team_leader/tme-edit',['tme'=>$tme]);
    }

    public function UpdateTLComment(Request $request){
        $userId = Session::get('sales_employee_id');
        $comment_count = DB::table('follow_up_comments')->where('tl_id',$userId)->where('tme_id',$request->tme_id)->count();

        if($comment_count > 0){
            DB::table('follow_up_comments')->where('tl_id',$userId)->where('tme_id',$request->tme_id)->update(['tl_comment'=>$request->tl_comment]);
        }else{
            $tlcomment['tl_id']       = $userId;
            $tlcomment['tme_id']      = $request->tme_id;
            $tlcomment['tl_comment']  = $request->tl_comment;
            DB::table('follow_up_comments')->insert($tlcomment);
            
        }
        return redirect('team-leader/tme');
    }

}
