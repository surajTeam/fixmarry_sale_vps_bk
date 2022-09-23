<?php

namespace App\Http\Controllers\Admin\TeamLeader;

use App\Http\Controllers\Controller;
use App\Models\SalesEmployee;
use App\Models\SalesRole;
use App\Models\register;
use App\Models\Lead;
use App\Models\SalesTeamLeaderEmployee;
use Illuminate\Http\Request;
use DB;

class TMEManagementController extends Controller
{
    public function assignTeamLeaderForm() {
    	$team_leader_role_id = SalesRole::where('name', 'team_leader')->first()['id'];
    	$team_leaders = SalesEmployee::where('role_id', $team_leader_role_id)->get();
    	
    	$tme_role_id = SalesRole::where('name', 'telemarketing_executive')->first()['id'];
    	$tme = SalesEmployee::where('role_id', $tme_role_id)->whereNotIn('id', function($q){
                $q->select('assigned_employee_id')->from('sales_team_leader_employees');
            })->get();

    	return view('admin.team_leader.tme.assign_form', compact('team_leaders', 'tme'));
    }

    public function assignTeamLeader(Request $request) {
    	$request->validate([
            'team_leader' => 'required',
            'tme' => 'required|array|min:1'
        ]);

        for ($i=0; $i < count($request->tme); $i++) { 
            SalesTeamLeaderEmployee::create([
                'team_leader_employee_id' => $request->team_leader,
                'assigned_employee_id' => $request->tme[$i]
            ]);
        }
        
        //return true;
        return redirect('admin/team-leader/assign-tme')->with('success', 'Lead created');
    }



// Admin assign Lead to TL 
    public function assignLeadForm() {
        $team_leader_role_id = SalesRole::where('name', 'team_leader')->first()['id'];
        $team_leaders = SalesEmployee::where('role_id', $team_leader_role_id)->get();
        
        // $tme_role_id = SalesRole::where('name', 'telemarketing_executive')->first()['id'];
        // $tme = SalesEmployee::where('role_id', $tme_role_id)->whereNotIn('id', function($q){
        //         $q->select('assigned_employee_id')->from('sales_team_leader_employees');
        //     })->get();

        //$leads = register::all();

      // $leads = Lead::where('tl_id', '=', '')->orWhereNull('tl_id')->get();
        $assigned_lead = register::join('assigned_leads','assigned_leads.lead_id','register.index_id')->select('register.index_id')->get()->toArray();
        $lead_id = array();
        if(count($assigned_lead)>0){
            foreach($assigned_lead as $assign){
                $lead_id[] = $assign['index_id'];
            }   
        }
        $leads = register::where('register.matri_id', '=',NULL)->whereNotIn('register.index_id',$lead_id)->get();
       // dd($leads);
        return view('admin.team_leader.tme.lead_assign_form', compact('team_leaders', 'leads'));
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

            Lead::where('id', $request->tme[$i])->update( ['tl_id' => $request->team_leader]); 

        }
        
        //return true;
        return redirect('admin/team-leader/assign-lead')->with('success', 'Lead Assigned');
    }


    public function listLead() {
        // $team_leader_role_id = SalesRole::where('name', 'team_leader')->first()['id'];
        // $team_leaders = SalesEmployee::where('role_id', $team_leader_role_id)->get();
        
        // $tme_role_id = SalesRole::where('name', 'telemarketing_executive')->first()['id'];
        // $tme = SalesEmployee::where('role_id', $tme_role_id)->whereNotIn('id', function($q){
        //         $q->select('assigned_employee_id')->from('sales_team_leader_employees');
        //     })->get();

        //$leads = Lead::all();

        //$leads = register::all();
        $teamleaders = SalesEmployee::where('role_id',2)->get();
        $leads = register::where('matri_id', '=', '')->orWhereNull('matri_id')->get();
        return view('admin.team_leader.tme.lead_list', compact('leads','teamleaders'));
    }

    public function viewTME($tmeid){
        $team_leader_lists = SalesTeamLeaderEmployee::select('assigned_employee_id')->where('team_leader_employee_id',$tmeid)->get();
        //dd( $team_leader_lists->salesEmployee->name);
        return view('admin.team_leader.tme-list',['tme_list'=>$team_leader_lists]);

      
    }
    public function LeadsComment($cmtid){//->whereNull('assigned_leads.comment')
        //DB::enableQueryLog();
 $lead_list = register::join('assigned_leads','assigned_leads.lead_id','register.index_id')->where('assigned_leads.lead_id', $cmtid)->whereNotNull('assigned_leads.comment')->get();
        //dd(DB::getQueryLog());
 $html = '';
 $html.='<table class="table table-bordered custom-table" id="employeeList" data-ordering="false">
             <thead>
                 <tr class="bg-primary text-white">
                     <th>Created On</th>
                     <th>Status</th>
                     <th>Leads History</th>
                     
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
    
    public function tlBasedTmeLeadsList($lead_id){
        $leadlist_desc = register::select(DB::raw('max(assigned_leads.id)'))->join('assigned_leads','assigned_leads.lead_id','register.index_id')
        ->where('assigned_leads.tme_id', $lead_id)
        ->orderby('assigned_leads.id')
        ->groupBy('assigned_leads.lead_id')->get();

        $lead_list = register::select('register.index_id','register.firstname','register.email','register.birthdate','register.mobile','assigned_leads.id','assigned_leads.lead_id','assigned_leads.status')
        ->join('assigned_leads','assigned_leads.lead_id','register.index_id')
        ->whereIn('assigned_leads.id', $leadlist_desc)
        ->get();
        return view('admin.team_leader.tme.list_leads_tme',['lead_list'=>$lead_list]);
    }
    public function allTeamleaders(){
        $teamleader = SalesEmployee::where('role_id',2)->get();
        return view('admin.team_leader.team-leader-list',['teamleader'=>$teamleader]);
    }
    
    public function addComment($teamleaderid){
        $teamleader = SalesEmployee::join('follow_up_comments','follow_up_comments.tl_id','sales_employees.id')->select('sales_employees.id','sales_employees.name','sales_employees.email','sales_employees.contact_number','sales_employees.fixmarry_employee_id','follow_up_comments.admin_comment')->where('sales_employees.id',$teamleaderid)->first();
        return view('admin.team_leader.add-comment',['teamleader'=>$teamleader]);
    }

    public function Updatecomment(Request $request){
        if($request->has('admin_comment')){
            $comment_count = DB::table('follow_up_comments')->where('tl_id',$request->team_leader_id)->count();
            if($comment_count==0){
                $insertcomment['tl_id']         = $request->team_leader_id;
                $insertcomment['admin_comment'] = $request->admin_comment;
                DB::table('follow_up_comments')->insert($insertcomment);
            }else{
                DB::table('follow_up_comments')->where('tl_id',$request->team_leader_id)->update(['admin_comment'=>$request->admin_comment]);
            }
            
        }
        return redirect('admin/team-leader/team-leader-list');
    }
    
}
