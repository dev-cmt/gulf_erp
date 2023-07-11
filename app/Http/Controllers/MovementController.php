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
use App\Models\Sales\Sales;
use App\Models\Sales\SalesDetails;
use App\Models\SlMovement;
use App\Models\User;
use App\Helpers\Helper;

class MovementController extends Controller
{
    public function grnPurchaseIndex()
    {
        $data = Purchase::where('status', 1)->get();
        return view('layouts.pages.inventory.purchase_receive.index',compact('data'));
    }
    public function grnPurchaseDetails($id)
    {   
        $purchase = Purchase::where('id', $id)->first();
        $data = PurchaseDetails::where('purchase_details.status', 1)->where('purchase_id', $id)
        ->join('purchases', 'purchases.id', 'purchase_details.purchase_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'purchase_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'purchases.mast_item_category_id')
        ->join('mast_suppliers', 'mast_suppliers.id', 'purchases.mast_supplier_id')
        ->select('purchase_details.*','purchases.inv_no','purchases.inv_date','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name','mast_suppliers.supplier_name')
        ->get();
        return view('layouts.pages.inventory.purchase_receive.grn_receive',compact('data','purchase'));
    }
    function grnPurchaseStore(Request $request) {
        
        $PurchaseDetails = PurchaseDetails::findOrFail($request->purchase_details_id);
        $PurchaseDetails->rcv_qty = $request->rcv_qty;
        $PurchaseDetails->save();
        
        if (isset($request->moreFile[0]['serial_no']) && !empty($request->moreFile[0]['serial_no'])) {
            foreach($request->moreFile as $item){
                $data = new SlMovement();
                $data->serial_no = $item['serial_no'];
                $data->reference_id = $request->purchase_id;
                $data->reference_type_id = 1; //1=> Purchase 2=> Sales 3=> Store Transfer
                $data->status = 1;
                $data->mast_item_register_id = $request->item_register_id;
                $data->mast_work_station_id = $request->work_station_id;
                $data->user_id = Auth::user()->id;
                $data->save();
            }
            return response()->json('success');
        }
        return response()->json(['errors' => $validator->errors()], 422);
    }
    /**___________________________________________________________________
     * Sales Delivery
     * ___________________________________________________________________
     */
    public function salesDeliveryIndex()
    {
        $data= Sales::where('status', 1)->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.sales_delivery.index',compact('data'));
    }
    public function salesDeliveryDetails($id)
    {
        $sales = Sales::where('id', $id)->first();
        $data = SalesDetails::where('sales_details.status', 1)->where('sales_id', $id)
        ->join('sales', 'sales.id', 'sales_details.sales_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sales_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'sales.mast_item_category_id')
        ->select('sales_details.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->get();
        
        $storeName= MastWorkStation::where('status', 1)->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.sales_delivery.delivery_details', compact('data','sales','storeName'));
    }
    function salesDeliveryStore(Request $request) {
        
        $salesDetails = SalesDetails::findOrFail($request->sales_details_id);
        $salesDetails->deli_qty = $request->deli_qty;
        $salesDetails->save();
        
        if (isset($request->moreFile[0]['serial_no']) && !empty($request->moreFile[0]['serial_no'])) {
            foreach($request->moreFile as $item){
                $data = SlMovement::findOrFail($item['serial_no']);
                $data->reference_id = $request->sales_id;
                $data->reference_type_id = 2; //1=> Purchase 2=> Sales 3=> Store Transfer
                $data->status = 0;
                $data->mast_item_register_id = $request->item_register_id;
                $data->user_id = Auth::user()->id;
                $data->save();
            }
            return response()->json('success');
        }
        return response()->json(['errors' => $validator->errors()], 422);
    }

    /**___________________________________________________________________
     * Ajax Call
     * ___________________________________________________________________
     */
    public function getPurchaseDetails(Request $request)
    {
        $data = PurchaseDetails::where('purchase_details.status', 1)->where('purchase_details.id', $request->id)
        ->join('purchases', 'purchases.id', 'purchase_details.purchase_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'purchase_details.mast_item_register_id')
        ->join('mast_suppliers', 'mast_suppliers.id', 'purchases.mast_supplier_id')
        ->join('mast_work_stations', 'mast_work_stations.id', 'purchases.mast_work_station_id')
        ->select('purchase_details.*','purchases.inv_no','purchases.inv_date','purchases.remarks','mast_item_registers.id as item_register_id','mast_item_registers.part_no','mast_suppliers.supplier_name','mast_work_stations.store_name','mast_work_stations.id as work_station_id')
        ->first();
        return response()->json($data);
    }
    public function getSalesDetails(Request $request)
    {
        
        $data = SalesDetails::where('sales_details.status', 1)->where('sales_details.id', $request->id)
        ->join('sales', 'sales.id', 'sales_details.sales_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'sales.mast_item_category_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sales_details.mast_item_register_id')
        ->join('mast_customers', 'mast_customers.id', 'sales.mast_customer_id')
        ->select('sales_details.*','sales.inv_no','sales.inv_date','sales.remarks','mast_item_categories.cat_name','mast_item_registers.id as item_register_id','mast_item_registers.part_no','mast_customers.name')
        ->first();
        return response()->json($data);
    }
    public function getSerialNumber(Request $request)
    {
        $count = SlMovement::where('mast_item_register_id', $request->item_register_id)->where('mast_work_station_id', $request->storeId)->where('status', 1)->count();
        $data = SlMovement::where('mast_item_register_id', $request->item_register_id)->where('mast_work_station_id', $request->storeId)->where('status', 1)->get();
        return response()->json([
            'count' => $count,
            'data' => $data
        ]);
    }
}
