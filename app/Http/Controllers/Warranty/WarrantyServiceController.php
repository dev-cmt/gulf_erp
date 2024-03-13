<?php

namespace App\Http\Controllers\Warranty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastCustomer;
use App\Models\Warranty\Complaint;
use App\Models\Warranty\JobCard;
use App\Models\Warranty\Requisition;
use App\Models\Warranty\RequisitionDetails;
use App\Models\Warranty\ServiceBill;
use App\Models\Warranty\ServiceBillDetails;
use App\Models\User;
use App\Models\Setup;
use App\Helpers\Helper;

class WarrantyServiceController extends Controller
{
    public function jobCardIndex()
    {
        $setup = Setup::first();
        $tecnician = User::where('info_personals.mast_designation_id', $setup->services_technician)
        ->join('info_personals', 'info_personals.emp_id', '=', 'users.id')
        ->leftJoin('job_cards', function ($join) {
            $join->on('job_cards.tech_id', '=', 'info_personals.emp_id')
                ->whereDate('job_cards.date', '=', date('Y-m-d'));
        })
        ->select('users.name', 'users.employee_code', 'users.contact_number', 'users.id', DB::raw('count(job_cards.date) as cnt'))
        ->groupBy('users.name', 'users.employee_code', 'users.contact_number', 'users.id')
        ->get();

        $compliant = Complaint::with('mastCustomer')->whereNotIn('id', function($q){
            $q->select('complaint_id')->from('job_cards')->where('date', date('Y-m-d'));
        })->get();

        return view('layouts.pages.warranty.job-card',compact('tecnician','compliant'));
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

        $jobNo = JobCard::where('date', date('Y-m-d'))->where('tech_id', $data->tech_id)->count();
        
        return response()->json([ 
            'jobNo' => $jobNo,
            'data' => $data,
        ]);
    }

    /**----------------------------------------------------------------------------------------
     *  WARRANTY => MOVEMENT
     * ---------------------------------------------------------------------------------------
     */
    public function movementIndex()
    {
        $data = JobCard::where('tech_id', 12)->get();

        return view('layouts.pages.warranty.movement', compact('data'));
    }
    public function movementStore(Request $request)
    {
        $jobCard = JobCard::find($request->job_card_id);
        $jobCard->in_time= $request->in_time;
        $jobCard->out_time= $request->out_time;
        $jobCard->is_tools = $request->is_tools;
        $jobCard->is_spare_parts = $request->is_spare_parts;
        $jobCard->is_next_visit = $request->is_next_visit;
        $jobCard->is_complete = $request->is_complete;
        $jobCard->note = $request->note;
        $jobCard->description = $request->description;
        $jobCard->status = ($request->is_next_visit == 1 || $request->is_complete == 1) ? 1 : 0;
        $jobCard->save();

        if ($request->is_next_visit == 1 && $request->is_complete == 0) {
            $nextCard = new JobCard();
            $nextDayTimestamp = strtotime(date('Y-m-d') . ' +1 day');
            $nextCard->date = date('Y-m-d', (date('N', $nextDayTimestamp) == 5) ? strtotime('next Saturday', $nextDayTimestamp) : $nextDayTimestamp);
            $nextCard->tech_id = $jobCard->tech_id;
            $nextCard->complaint_id = $request->complaint_id;
            $nextCard->user_id = Auth::user()->id;
            $nextCard->save();
        }
        
        if ($request->is_complete == 1 && $request->is_next_visit == 0) {
            if ($compliant = Complaint::find($request->complaint_id)) {
                $compliant->status = 1;
                $compliant->save();
            }
        }
        
        $notification=array('messege'=>'Save successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    /**----------------------------------------------------------------------------------------
     *  WARRANTY => REQUSITION
     * ---------------------------------------------------------------------------------------
     */
    public function requisitionIndex()
    {
        $data = Requisition::get();
        $history = JobCard::where('status', 1)->where('tech_id', 12)->get();

        return view('layouts.pages.warranty.item-requisition', compact('history', 'data'));
    }
     public function requisitionStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'requ_date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $IDGenarator = Helper::IDGenerator(new Requisition,'requ_no', 5, "REQU");
        $storeRequisition = new Requisition();
        $storeRequisition->requ_no = $IDGenarator;
        $storeRequisition->requ_date = $request->requ_date;
        $storeRequisition->tech_id = $request->tech_id;
        $storeRequisition->complaint_id = $request->complaint_id;
        $storeRequisition->remarks = $request->remarks;
        $storeRequisition->status = 0;
        $storeRequisition->user_id = Auth::user()->id;
        $storeRequisition->save();

        if (isset($request->moreFile[0]['item_category']) && !empty($request->moreFile[0]['item_category'])) {
            foreach($request->moreFile as $item){
                $data = new RequisitionDetails();
                $data->requisition_id = $storeRequisition->id;
                $data->mast_item_category_id = $item['item_category'];
                $data->mast_item_group_id = $item['item_group'];
                $data->mast_item_register_id = $item['item_register'];
                $data->qty = $item['qty'];
                $data->rcv_qty = 0;
                $data->status = 0;
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        return response()->json(['message' => 'success']);        
    }

    

    /**----------------------------------------------------------------------------------------
     *  WARRANTY => REQUSITION
     * ---------------------------------------------------------------------------------------
     */
    public function serviceBillIndex()
    {
        $data = ServiceBill::get();
        return view('layouts.pages.warranty.service-bill', compact('data'));
    }
    public function serviceBillStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bill_date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $IDGenarator = Helper::IDGenerator(new ServiceBill,'bill_no', 5, "SBN");
        $data = new ServiceBill();
        $data->bill_no = $IDGenarator;
        $data->bill_date = $request->bill_date;
        $data->complaint_id = $request->complaint_id;
        $data->mast_customer_id = $request->mast_customer_id;
        $data->tech_id = $request->tech_id;
        $data->remarks = $request->remarks;
        $data->status = 0;
        $data->user_id = Auth::user()->id;
        $data->save();

        if (isset($request->moreFile[0]['description']) && !empty($request->moreFile[0]['description'])) {
            foreach($request->moreFile as $item){
                $details = new ServiceBillDetails();
                $details->description = $item['description'];
                $details->qty = $item['qty'];
                $details->price = $item['price'];
                $details->total = $details->qty * $details->price;
                $details->service_bill_id = $data->id;
                $details->user_id = Auth::user()->id;
                $details->status = 0;
                $details->save();
            }
        }
        return response()->json(['message' => 'success']);
    }

    function serviceBillReceive(Request $request) { // USE => service-bill Page
        
        $data = ServiceBillDetails::find($request->id);
        $data->status = 1;
        $data->save();
        
        return response()->json($data);
    }
     
    /**_________________________________________________________________
     * GET AJAX DATA
     * _________________________________________________________________
     */
    function getComplaintDetails(Request $request) { // USE => complaint.index Page
        if($request->check == 1){
            $compliant = Complaint::with('mastCustomer')->where('tech_id', $request->id)->where('status', 0)->get()->toArray();
        }if($request->check == 2){
            $compliant = Complaint::with('mastCustomer')->where('tech_id', null)->where('status', 0)->get()->toArray();
        }else{
            $compliant = Complaint::with('mastCustomer')->where('status', 0)->get()->toArray();
        }
        $jobNo = JobCard::where('date', date('Y-m-d'))->where('tech_id', $request->id)->count();
        $user = User::where('id', $request->id)->first();
        return response()->json([ 
            'technicin_name' => $user->name,
            'jobNo' => $jobNo,
            'compliant' => $compliant,
        ]);
    }
    function getJobCardDetails(Request $request) { // USE => job-card Page
        $data = JobCard::with('technician', 'complaint')->where('id', $request->jobCardId)->where('tech_id', $request->techId)->get()->toArray();
        
        return response()->json([ 
            'data' => $data,
        ]);
    }

    public function getItemCategory(Request $request) { // USE => movement Page
        $data = MastItemGroup::with('mastItemCategory')->whereIn('mast_item_category_id', [$request->typeId])->get()->toArray();
        
        return response()->json($data);
    }
   
    public function getRequisitionDetails(Request $request) { // USE => movement Page
        $requisitions = Requisition::where('complaint_id', $request->complaint_id)->get();
        $getId = $requisitions->pluck('id')->toArray();
        $data = RequisitionDetails::with('requisition', 'mastItemCategory', 'mastItemGroup', 'mastItemRegister')
                                    ->whereIn('requisition_id', $getId)->get();
        
        return response()->json($data);
    }  
    public function getServiceBillDetails(Request $request) { // USE => movement Page
        $serviceBill = ServiceBill::where('mast_customer_id', $request->mast_customer_id)->get();
        $getId = $serviceBill->pluck('id')->toArray();
        $data = ServiceBillDetails::with('serviceBill')->whereIn('service_bill_id', $getId)->get();
        
        return response()->json($data);
    }  
    
    public function getRequisition(Request $request) { // USE => item-requsition Page
        $data = Requisition::with(['complaint.compliantType', 'technician', 'requisitionDetails.mastItemCategory', 'requisitionDetails.mastItemGroup', 'requisitionDetails.mastItemRegister'])
                            ->find($request->id);
    
        return response()->json($data);
    }
    public function requisitionApprove(Request $request) { // USE => item-requsition Page
        $data = RequisitionDetails::find($request->id);
        if($request->status == 1){
            $data->rcv_qty = $data->rcv_qty + $request->rcv_qty;
        }else{
            $data->rcv_qty = $data->rcv_qty - $request->rcv_qty;
        }
        $data->status = $request->status;
        $data->save();
    
        return response()->json($data);
    } 
    public function getServiceBill(Request $request) { // USE => service-bill Page
        $data = ServiceBill::with('complaint', 'technician', 'mastCustomer', 'serviceBillDetails')->find($request->id);
        
        return response()->json($data);
    } 
    
}
