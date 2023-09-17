<?php

namespace App\Http\Controllers\Warranty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\InfoPersonal;
use App\Models\Warranty\Complaint;
use App\Models\Warranty\JobCard;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;


class jobcardController extends Controller
{
    public function jobCardIndex()
    {
        // $tecnician = InfoPersonal::where('mast_designation_id',9)
        // ->join('job_cards','job_cards.tech_id','info_personals.id')
        // ->join('users','users.id','info_personals.user_id')
        // ->select('users.name','users.employee_code')
        // // ->groupBy('info_personals.id')
        // ->get();

        $tecnician = DB::table('users')
        ->join('info_personals','info_personals.emp_id','users.id')
        ->leftjoin('job_cards','job_cards.tech_id','=','info_personals.id')
        ->where('job_cards.job_date', date('Y-m-d'))
        ->select('users.name','users.employee_code','users.id',DB::raw('count(*) as cnt'))
        // ->select('users.name','users.employee_code','users.id','job_cards.job_date')
        ->groupBy('users.name','users.employee_code','users.id')
        ->get();
        // dd($tecnician);

        $compliant = Complaint::with('custo')->whereNotIn('id', function($q){
            $q->select('tracking_no')->from('job_cards')->where('job_date', date('Y-m-d'));
        })->get();

        // $compliant = Complaint::with('custo')->where('issue_date',date('Y-m-d'))->get();
        // dd($compliant);
        return view('layouts.pages.warranty.jobcard.index',compact('tecnician','compliant'));
    }

    public function technicianAdd(Request $request)
    {
        $techAdd = User::where('id',$request->id)->first();
         return response()->json($techAdd);
    }
    public function storeJobCard(Request $request)
    {

            $jobCard = new JobCard();
            $jobCard->job_date      = $request->cur_date;
            $jobCard->tech_id       = $request->techId;
            $jobCard->tracking_no   = $request->com_Id;
            $jobCard->user_id       =  Auth::user()->id;
            $jobCard->save();
            return response()->json('success');


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

}
