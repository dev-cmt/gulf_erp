<?php


namespace App\Http\Controllers\Warranty;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastCustomer;
use App\Models\Master\MastItemRegister;
use App\Helpers\Helper;
use App\Models\Warranty\Complaint;
use App\Models\Warranty\Requisition;
use App\Models\Warranty\RequisitionDetails;


class RequisitionController extends Controller
{
    public function indexTools()
    {
        $item_group = MastItemGroup::where('mast_item_category_id', 4)->where('status', 1)->orderBy('part_name', 'asc')->get();

        // $complaintt = Complaint::with('complaintType')->get();
        $customer = MastCustomer::where('status', 1)->get();

        // $data = Requisition::where('mast_item_category_id', 4)->with('complaintType','requisitionDetails','mastCustomer')->orderBy('id', 'desc')->latest()->get();

        $data = Complaint::with('complaintType')->get();
        $list = Requisition::all();
        // dd($list);

        return view('layouts.pages.warranty.tools_requisition.index',compact('customer','item_group','data','list'));
    }

    public function toolsList()
    {
        $item_group = MastItemGroup::where('mast_item_category_id', 4)->where('status', 1)->orderBy('part_name', 'asc')->get();
        $customer = MastCustomer::where('status', 1)->get();
        $data = Complaint::with('complaintType')->get();
        $list = Requisition::all();

        $job = DB::table('job_cards')
        ->join('users','users.id','job_cards.tech_id')
        ->join('complaints','complaints.id','job_cards.tracking_no')
        ->get()->toArray();
        // dd($job);
        return view('layouts.pages.warranty.tools_requisition.requisiton-list',compact('customer','item_group','data','list'));
    }

    public function storeTools(Request $request)
    {
        //  $purchase_codes = Helper::IDGenerator(new Requisition, 'requ_no', 5, "REQUISITION-NO"); /* Generate id */ 
        $requ_id=$request->requ_id;
        if(isset($requ_id)){
            $storePurchase = Requisition::findOrFail($requ_id);
        }else{
            $validator = Validator::make($request->all(), [
               
                'requ_date' => 'required',
                'mast_customer_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $storePurchase = new Requisition();
            // $storePurchase->requ_no = $purchase_codes;
        }

        $IDGenarator = Helper::IDGenerator(new Requisition,'requ_no', 5, "REQU");
        $storePurchase->requ_no = $request->requ_no;
        $storePurchase->requ_date = $request->requ_date;
        $storePurchase->remarks = $request->remarks;
        $storePurchase->status = 0;
        $storePurchase->requ_no = $IDGenarator;
        $storePurchase->mast_item_category_id = 4;
        // $storePurchase->mast_customer_id = $request->mast_customer_id;
        
        $storePurchase->user_id = Auth::user()->id;
        $storePurchase->save();

        if (isset($request->moreFile[0]['item_id']) && !empty($request->moreFile[0]['item_id'])) {
            foreach($request->moreFile as $item){

                $data = new RequisitionDetails();

                $data->requ_id = $storePurchase->id;
                $data->cat_id = 4;
                $data->mast_item_register_id = $item['item_id'];
                $data->qty = $item['qty'];
                $data->rcv_qty = 0;
                
               
                $data->user_id = Auth::user()->id;
                $data->save();

            }
        }
        return response()->json('success');
        
    }

    public function inv_purchase_destroy($id)
    {
        $data=RequisitionDetails::find($id);
        $data->delete();
        return response()->json('success');
    }

    public function getPartNumber(Request $request)
    {
        $data = MastItemRegister::where('mast_item_group_id', $request->part_id)->get();
        return view('layouts.pages.warranty.load-part-number',compact('data'));
    }

    public function anotherField(Request $request)
    {
        $anotherField = MastItemRegister::where('id', $request->part_id)->with('unit')->first();
       
        return response()->json($anotherField);
    }

    public function edit(Request $request)
    {
        // Get active customers
        $data = Requisition::where('id', $request->id)->first();

        return response()->json([
            'data'   =>$data,
            // 'complaintt' => $complaintt,
            // 'customer' => $customer,
            // 'purchase_details' => $purchase_details,
        ]);
        
    }

    
    /**_____________________________________________________________________________
     * Spare Part Requisition
     * _____________________________________________________________________________
     */
    public function indexSparePart()
    {
        $item_group = MastItemGroup::where('mast_item_category_id', 2)->where('status', 1)->orderBy('part_name', 'asc')->get();
        $complaintt = Complaint::with('complaintType')->get();
        $customer = MastCustomer::where('status', 1)->get();

        return view('layouts.pages.warranty.spare_part.index' , compact('item_group','complaintt','customer'));
    }


    
}

   
