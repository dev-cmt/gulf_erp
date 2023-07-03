<?php

namespace App\Http\Controllers;

// use App\Http\Controller\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\MastItemCategory;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastItemRegister;
use App\Models\Master\MastUnit;
use App\Models\Master\MastSupplier;
use App\Models\Inventory\Purchase;
use App\Models\Inventory\PurchaseDetails;
use App\Models\SlMovement;
use App\Models\User;
use App\Helpers\Helper;

class MovementController extends Controller
{
    public function grmPurchaseIndex()
    {
        $data = Purchase::where('status', 1)->get();
        return view('layouts.pages.inventory.purchase_receive.index',compact('data'));
    }
    public function grmPurchaseDetails($id)
    {
        $data = PurchaseDetails::where('purchase_details.status', 1)->where('purchase_id', $id)
        ->join('purchases', 'purchases.id', 'purchase_details.purchase_id')
        ->join('mast_customers', 'mast_customers.id', 'purchases.mast_supplier_id')
        ->select('purchase_details.*','purchases.inv_no','purchases.inv_date','mast_customers.name')
        ->get();
        return view('layouts.pages.inventory.purchase_receive.grn_receive',compact('data'));
    }
    function getPurchaseStore(Request $request) {
        
        if (isset($request->moreFile[0]['serial_no']) && !empty($request->moreFile[0]['serial_no'])) {
            foreach($request->moreFile as $item){
                $data = new SlMovement();
                $data->serial_no = $item['serial_no'];
                $data->item_id = 1;
                $data->ref_id = 1;
                $data->ref_type = 1;
                $data->status = 1;
                $data->mast_work_station_id = 1;
                $data->user_id = Auth::user()->id;
                $data->save();
            }
            return response()->json('success');
        }
        return response()->json(['errors' => $validator->errors()], 422);

        // $data = new SlMovement();
        // $data->serial_no = $request->serial_no;
        // $data->item_id = $request->item_id;
        // $data->ref_id = $request->ref_id;
        // $data->ref_type = $request->ref_type;
        // $data->status = $request->status;
        // $data->mast_work_station_id = $request->mast_work_station_id;
        // $data->user_id = $request->user_id;
        // $data->save();
    }
    /**___________________________________________________________________
     * Ajax Call Show Data
     * ___________________________________________________________________
     */
    public function getPurchaseDetails(Request $request)
    {
        $data = PurchaseDetails::where('purchase_details.status', 1)->where('purchase_details.id', $request->id)
        ->join('purchases', 'purchases.id', 'purchase_details.purchase_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'purchase_details.mast_item_register_id')
        ->join('mast_customers', 'mast_customers.id', 'purchases.mast_supplier_id')
        ->join('mast_work_stations', 'mast_work_stations.id', 'purchases.mast_work_station_id')
        ->select('purchase_details.*','purchases.inv_no','purchases.inv_date','mast_item_registers.part_no','mast_customers.name','mast_work_stations.store_name')
        ->first();
        return response()->json($data);
    }
}
