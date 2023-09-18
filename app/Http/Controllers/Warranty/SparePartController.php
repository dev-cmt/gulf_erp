<?php

namespace App\Http\Controllers\Warranty;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warranty\Spare;
use App\Models\Warranty\SpareDetails;
use App\Helpers\Helper;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastCustomer;
use App\Models\Warranty\Complaint;
use App\Models\Warranty\Requisition;
use DB;
use Response;
class SparePartController extends Controller
{

    public function sparePartList()
    {
        $item_group = MastItemGroup::where('mast_item_category_id', 2)->where('status', 1)->orderBy('part_name', 'asc')->get();
        $customer = MastCustomer::where('status', 1)->get();
        $data = Complaint::with('complaintType')->get();
        $list = Requisition::all();

        $job = DB::table('job_cards')
        ->join('users','users.id','job_cards.tech_id')
        ->join('complaints','complaints.id','job_cards.tracking_no')
        ->get()->toArray();
        // dd($job);
        return view('layouts.pages.warranty.spare_part.spare-part-list',compact('customer','item_group','data','list'));
    }

    public function getComplanitData(Request $request)
    {
        $viewComplaint = Complaint::with('mastCustomer')->where('id',$request->complaint_id)->first()->toArray();
        return response()->json([
            'viewComplaint' => $viewComplaint,
        ]);
    }

    public function spareTools(Request $request)
    {
        //  $purchase_codes = Helper::IDGenerator(new Requisition, 'requ_no', 5, "REQUISITION-NO"); /* Generate id */ 
        $requ_id=$request->requ_id;
        if(isset($requ_id)){
            $storePurchase = Spare::findOrFail($requ_id);
        }else{
            $validator = Validator::make($request->all(), [
                
                'requ_date' => 'required',
                'mast_customer_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $storePurchase = new Spare();
            // $storePurchase->requ_no = $purchase_codes;
        }
        $IDGenarator = Helper::IDGenerator(new Spare,'requ_no', 5, "REQU");
        $storePurchase->requ_no = $request->requ_no;
        $storePurchase->requ_date = $request->requ_date;
        $storePurchase->remarks = $request->remarks;
        $storePurchase->status = 0;
        $storePurchase->requ_no = $IDGenarator;
        $storePurchase->mast_item_category_id = 2;
        // $storePurchase->mast_customer_id = $request->mast_customer_id;
        
        $storePurchase->user_id = Auth::user()->id;
        $storePurchase->save();

        if (isset($request->moreFile[0]['item_id']) && !empty($request->moreFile[0]['item_id'])) {
            foreach($request->moreFile as $item){

                $data = new SpareDetails();

                $data->requ_id = $storePurchase->id;
                $data->cat_id = 2;
                $data->mast_item_register_id = $item['item_id'];
                $data->qty = $item['qty'];
                $data->rcv_qty = 0;
                
               
                $data->user_id = Auth::user()->id;
                $data->save();

            }
        }
        return response()->json('success');
        
    }
    
    // public function calcList($id)
    // {

    // $designId = Complaint::find($id);
    // $design = Complaint::select( `issue_no`, `issue_date` , `mast_customer_id`)->where('id','=',$designId);
    // // return Response::json(array('datas' => $design));
    // // return response()->json(['data'=>$design]);
    // return Response::json($design);
    // }
}
