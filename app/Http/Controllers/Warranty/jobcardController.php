<?php

namespace App\Http\Controllers\Warranty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\InfoPersonal;
use App\Models\Warranty\Complaint;
use App\Models\Warranty\JobCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Setup;


class JobCardController extends Controller
{
    public function jobCardIndex()
    {
        $setup = Setup::first();
        $tecnician = User::where('info_personals.mast_designation_id', $setup->services_technician)
        ->join('info_personals','info_personals.emp_id','=','users.id')
        ->leftjoin('job_cards','job_cards.tech_id','=','info_personals.id')
        ->select('users.name','users.employee_code','users.id', DB::raw('count(*) as cnt'))
        ->groupBy('users.name','users.employee_code','users.id')
        ->get();
      

        $compliant = Complaint::with('mastCustomer')->whereNotIn('id', function($q){
            $q->select('complaint_id')->from('job_cards')->where('date', date('Y-m-d'));
        })->get();

        // $compliant = Complaint::with('custo')->where('issue_date',date('Y-m-d'))->get();
        // dd($compliant);
        return view('layouts.pages.warranty.jobcard.index',compact('tecnician','compliant'));
    }
    public function jobCardStore(Request $request)
    {
        $data = new JobCard();
        $data->date = date('Y-m-d');
        $data->tech_id = $request->tech_id;
        $data->complaint_id= $request->compliant_id;
        $data->user_id = Auth::user()->id;
        $data->save();

        $complaint = Complaint::findOrFail($data->complaint_id);
        $complaint->tech_id = $data->tech_id;
        $complaint->save();

        $jobNo = JobCard::where('date', date('Y-m-d'))->count();
        return response()->json([ 
            'jobNo' => $jobNo,
        ]);
    }

    public function technicianAdd(Request $request)
    {
        $techAdd = User::where('id',$request->id)->first();
         return response()->json($techAdd);
    }
   

    public function jobCardpage()
    {
        $job = DB::table('job_cards')
        ->join('users','users.id','job_cards.tech_id')
        ->join('complaints','complaints.id','job_cards.tracking_no')
        // ->where('job_cards.job_date',date('Y-m-d'))
        ->where('job_cards.tech_id',Auth::user()->id)
        ->get();
        // dd($job);

        $jobvisit = JobCard::with('tecName')->first();
        // dd($jobvisit);
        return view('layouts.pages.warranty.jobcard.jobCardPage',compact('job','jobvisit'));
    }

    public function storeJobVisit(Request $request)
    {

        $jobCard = new JobCard();
        $jobCard->is_next_visit      = $request->nextVisit;
        $jobCard->next_date          = $request->nextDate;
        $jobCard->is_complete       = $request->isComplete;
        $jobCard->is_spare_parts    = $request->isSpareParts;
        $jobCard->note              = $request->note;
        $jobCard->observe_details   = $request->observeDetails;
        $jobCard->save();
        return response()->json('success');
    }

    /**_________________________________________________________________
     * GET AJAX DATA
     * _________________________________________________________________
     */
    function getComplaintDetails(Request $request) {
        $compliant = Complaint::with('mastCustomer')->where('status', 0)->get()->toArray();
        $jobNo = JobCard::where('date', date('Y-m-d'))->count();
        $user = User::where('id', $request->id)->first();
        return response()->json([ 
            'technicin_name' => $user->name,
            'jobNo' => $jobNo,
            'compliant' => $compliant,
        ]);
    }

}
