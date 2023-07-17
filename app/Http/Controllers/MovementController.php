<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarcodeExport;
use App\Exports\ItemExport;
use PDF;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use App\Models\Master\MastItemCategory;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastItemRegister;
use App\Models\Master\MastUnit;
use App\Models\Master\MastSupplier;
use App\Models\Inventory\Purchase;
use App\Models\Inventory\PurchaseDetails;
use App\Models\Inventory\StoreTransfer;
use App\Models\Inventory\StoreTransferDetails;
use App\Models\Sales\Sales;
use App\Models\Sales\SalesDetails;
use App\Models\SlMovement;
use App\Models\User;
use App\Helpers\Helper;

class MovementController extends Controller
{
    public function grnPurchaseIndex()
    {
        $data = Purchase::where('status', 1)->orderBy('id', 'asc')->get();
        $dataParsial = Purchase::whereIn('status', [3, 4])->where('is_parsial', 1)->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.purchase_receive.index',compact('data','dataParsial'));
    }
    public function grnPurchaseDetails($id)
    {   
        $purchase = Purchase::where('id', $id)->orderBy('id', 'asc')->first();
        $data = PurchaseDetails::where('purchase_details.status', 1)->where('purchase_id', $id)
        ->join('purchases', 'purchases.id', 'purchase_details.purchase_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'purchase_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'purchases.mast_item_category_id')
        ->join('mast_suppliers', 'mast_suppliers.id', 'purchases.mast_supplier_id')
        ->select('purchase_details.*','purchases.inv_no','purchases.inv_date','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name','mast_suppliers.supplier_name')
        ->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.purchase_receive.grn_receive',compact('data','purchase'));
    }
    function grnPurchaseStore(Request $request) {
        
        $purchaseDetails = PurchaseDetails::findOrFail($request->purchase_details_id);
        $purchaseDetails->rcv_qty = $request->rcv_qty;
        $purchaseDetails->save();

        if (isset($request->moreFile[0]['serial_no']) && !empty($request->moreFile[0]['serial_no'])) {
            foreach($request->moreFile as $item){
                $data = new SlMovement();
                $data->serial_no = $item['serial_no'];
                $data->reference_id = $request->purchase_id;
                $data->reference_type_id = 1; //1=> Purchase || 2=> Sales || 3=> Store Transfer || 4=> Sales Return
                $data->status = 1;
                $data->mast_item_register_id = $request->item_register_id;
                $data->mast_work_station_id = $request->work_station_id;
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        //___________Purchase Update
        $checkPurchase = PurchaseDetails::where('purchase_id', $purchaseDetails->purchase_id)->get();
        $allTrue = true;
        foreach ($checkPurchase as $key => $value) {
            if ($value->qty != $value->rcv_qty) {
                $allTrue = false;
                break;
            }
        }
        if ($allTrue){
            $purchaseUpdate = Purchase::findOrFail($purchaseDetails->purchase_id);
            $purchaseUpdate->status = 4; // Pendding => 0 || Success => 1 || Cencel => 2 || Parsial => 3 || Complete => 4
            $variable = SlMovement::where('reference_id', $purchaseDetails->purchase_id)->where('reference_type_id', 1)
                    ->whereDate('created_at', '!=', date('Y-m-d'))->where('status', 1)->count();
            if($variable){
                $purchaseUpdate->is_parsial = 1;
            }else{
                $purchaseUpdate->is_parsial = 0;
            }
            $purchaseUpdate->save();
        }else{
            $purchaseUpdate = Purchase::findOrFail($purchaseDetails->purchase_id);
            $purchaseUpdate->status = 3; // Pendding => 0 || Success => 1 || Cencel => 2 || Parsial => 3 || Complete => 4
            $purchaseUpdate->is_parsial = 1;
            $purchaseUpdate->save();
        }
        
        return response()->json('success');
    }
    function parsialPurchaseDetails($id) { 
        $purchase = Purchase::where('id', $id)->orderBy('id', 'asc')->first();
        
        $data = SlMovement::where('sl_movements.reference_id', $id)->where('sl_movements.reference_type_id', 1)
        ->join('purchases', 'purchases.id', 'sl_movements.reference_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'mast_item_groups.mast_item_category_id')
        ->select('sl_movements.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.purchase_receive.parsial-purchase-receive',compact('purchase','data'));
    }
    /**___________________________________________________________________
     * Sales Delivery
     * ___________________________________________________________________
     */
    public function salesDeliveryIndex()
    {
        $data= Sales::where('status', 1)->orderBy('id', 'asc')->get();
        $dataParsial = Sales::whereIn('status', [3, 4])->where('is_parsial', 1)->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.sales_delivery.index',compact('data','dataParsial'));
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
        
        return view('layouts.pages.inventory.sales_delivery.delivery_details', compact('data','sales'));
    }
    function salesDeliveryStore(Request $request) {
        
        $salesDetails = SalesDetails::findOrFail($request->sales_details_id);
        $salesDetails->deli_qty = $request->deli_qty;
        $salesDetails->save();
        
        if (isset($request->moreFile[0]['serial_no']) && !empty($request->moreFile[0]['serial_no'])) {
            foreach($request->moreFile as $item){
                $dataUpdate = SlMovement::findOrFail($item['serial_no']);
                $dataUpdate->status = 0;
                $dataUpdate->out_date = date('Y-m-d');
                $dataUpdate->save();
                $data = new SlMovement();
                $data->serial_no = $dataUpdate->serial_no;
                $data->reference_id = $request->sales_id;
                $data->reference_type_id = 2; //1=> Purchase 2=> Sales 3=> Store Transfer 4=> Return
                $data->status = 0;
                $data->mast_item_register_id = $request->item_register_id;
                $data->mast_work_station_id = Auth::user()->id;
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        //___________ Sales Status Update
        $checkSales = SalesDetails::where('sales_id', $salesDetails->sales_id)->get();
        $allTrue = true;
        foreach ($checkSales as $key => $value) {
            if ($value->qty != $value->deli_qty) {
                $allTrue = false;
                break;
            }
        }
        if ($allTrue){
            $salesUpdate = Sales::findOrFail($salesDetails->sales_id);
            $salesUpdate->status = 4; // Pendding => 0 || Success => 1 || Cencel => 2 || Parsial => 3 || Complete => 4
            $variable = SlMovement::where('reference_id', $salesDetails->sales_id)->where('reference_type_id', 2)
                    ->whereDate('created_at', '!=', date('Y-m-d'))->where('status', 0)->count();
            if($variable){
                $salesUpdate->is_parsial = 1;
            }else{
                $salesUpdate->is_parsial = 0;
            }
            $salesUpdate->save();
        }else{
            $salesUpdate = Sales::findOrFail($salesDetails->sales_id);
            $salesUpdate->status = 3; // Pendding => 0 || Success => 1 || Cencel => 2 || Parsial => 3 || Complete => 4
            $salesUpdate->is_parsial = 1;
            $salesUpdate->save();
        }
        return response()->json('success');
    }
    function parsialSalesDeliveryDetails($id) { 
        $sales = Sales::where('id', $id)->orderBy('id', 'asc')->first();
        
        $data = SlMovement::where('sl_movements.reference_id', $id)->where('sl_movements.reference_type_id', 2)
        ->join('sales', 'sales.id', 'sl_movements.reference_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'mast_item_groups.mast_item_category_id')
        ->select('sl_movements.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->orderBy('id', 'asc')->get();

        return view('layouts.pages.inventory.sales_delivery.parsial-delivery-details',compact('sales','data'));
    }
    /**___________________________________________________________________
     * Requstion Delivery (Store Transfer)
     * ___________________________________________________________________
     */
    public function requstionDeliveryIndex()
    {
        $data= StoreTransfer::where('status', 1)->orderBy('id', 'asc')->get();
        $dataParsial = StoreTransfer::whereIn('status', [3, 4])->where('is_parsial', 1)->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.requstion_delivery.index',compact('data','dataParsial'));
    }
    public function requstionDeliveryDetails($id)
    {
        $sales = StoreTransfer::where('id', $id)->first();
        $data = StoreTransferDetails::where('store_transfer_details.status', 1)->where('store_transfer_id', $id)
        ->join('store_transfers', 'store_transfers.id', 'store_transfer_details.store_transfer_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'store_transfer_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'store_transfers.mast_item_category_id')
        ->select('store_transfer_details.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->get();
        
        return view('layouts.pages.inventory.requstion_delivery.delivery_details', compact('data','sales'));
    }
    function requstionDeliveryStore(Request $request) {
        
        $storeTransferDetails = StoreTransferDetails::findOrFail($request->store_transfer_details_id);
        $storeTransferDetails->deli_qty = $request->deli_qty;
        $storeTransferDetails->save();
        
        if (isset($request->moreFile[0]['serial_no']) && !empty($request->moreFile[0]['serial_no'])) {
            foreach($request->moreFile as $item){
                $dataUpdate = SlMovement::findOrFail($item['serial_no']);
                $dataUpdate->status = 0;
                $dataUpdate->out_date = date('Y-m-d');
                $dataUpdate->save();
                $data = new SlMovement();
                $data->serial_no = $dataUpdate->serial_no;
                $data->reference_id = $request->store_transfer_id;
                $data->reference_type_id = 3; //1=> Purchase || 2=> Sales || 3=> Store Transfer || 4=> Return
                $data->status = 1;
                $data->mast_item_register_id = $request->item_register_id;
                $data->mast_work_station_id = $request->mast_work_station_id;
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        //___________ Store Transfer Status Update
        $checkStoreTransfer = StoreTransferDetails::where('store_transfer_id', $storeTransferDetails->store_transfer_id)->get();
        $allTrue = true;
        foreach ($checkStoreTransfer as $key => $value) {
            if ($value->qty != $value->deli_qty) {
                $allTrue = false;
                break;
            }
        }
        if ($allTrue){
            $storeTransferUpdate = StoreTransfer::findOrFail($storeTransferDetails->store_transfer_id);
            $storeTransferUpdate->status = 4; // Pendding => 0 || Success => 1 || Cencel => 2 || Parsial => 3 || Complete => 4
            $variable = SlMovement::where('reference_id', $storeTransferDetails->store_transfer_id)->where('reference_type_id', 1)
                    ->whereDate('created_at', '!=', date('Y-m-d'))->where('status', 3)->count();
            if($variable){
                $storeTransferUpdate->is_parsial = 1;
            }else{
                $storeTransferUpdate->is_parsial = 0;
            }
            $storeTransferUpdate->save();
        }else{
            $storeTransferUpdate = StoreTransfer::findOrFail($storeTransferDetails->store_transfer_id);
            $storeTransferUpdate->status = 3; // Pendding => 0 || Success => 1 || Cencel => 2 || Parsial => 3 || Complete => 4
            $storeTransferUpdate->is_parsial = 1;
            $storeTransferUpdate->save();
        }
        return response()->json('success');
    }
    function parsialRequstionDeliveryDetails($id) { 
        $storeTransfer = StoreTransfer::where('id', $id)->orderBy('id', 'asc')->first();
        
        $data = SlMovement::where('sl_movements.reference_id', $id)->where('sl_movements.reference_type_id', 3)
        ->join('store_transfers', 'store_transfers.id', 'sl_movements.reference_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'mast_item_groups.mast_item_category_id')
        ->select('sl_movements.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.requstion_delivery.parsial-requstion-delivery',compact('storeTransfer','data'));
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
    public function getStoreTransferDetails(Request $request)
    {
        $data = StoreTransferDetails::where('store_transfer_details.status', 1)->where('store_transfer_details.id', $request->id)
        ->join('store_transfers', 'store_transfers.id', 'store_transfer_details.store_transfer_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'store_transfers.mast_item_category_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'store_transfer_details.mast_item_register_id')
        ->join('mast_work_stations as from_station', 'from_station.id', 'store_transfers.from_store_id')
        ->join('mast_work_stations as to_station', 'to_station.id', 'store_transfers.mast_work_station_id')
        ->select('store_transfer_details.*','store_transfers.inv_no','store_transfers.inv_date','store_transfers.from_store_id','store_transfers.mast_work_station_id','store_transfers.remarks','mast_item_categories.cat_name','mast_item_registers.id as item_register_id','mast_item_registers.part_no', 'from_station.store_name as from_store_name', 'to_station.store_name as to_store_name')
        ->first();
        return response()->json($data);
    }

    public function getSerialNumber(Request $request){
        //--Use Sales Delivery Page Or Store Transfer
        $data = SlMovement::where('mast_item_register_id', $request->item_register_id)->where('mast_work_station_id', $request->storeId)->whereIn('reference_type_id', [1,3])->where('status', 1)->get();
        return response()->json(['data' => $data]);
    }

    /**___________________________________________________________________
     * Dwonload File, Excel, Pdf
     * ___________________________________________________________________
     */
    public function generatePurchaseReceive($id){
        $purchase = Purchase::where('id', $id)->orderBy('id', 'asc')->first();
        
        $data = SlMovement::where('sl_movements.reference_id', $id)->where('sl_movements.reference_type_id', 1)
        ->join('purchases', 'purchases.id', 'sl_movements.reference_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'mast_item_groups.mast_item_category_id')
        ->select('sl_movements.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->orderBy('id', 'asc')->get();
       
        $pdf = PDF::loadView('layouts.pages.export.parsial-purchase-receive', compact('purchase','data'))->setPaper('a4', 'portrait');
        return $pdf->download('items6.pdf');
        // return view('layouts.pages.export.parsial-purchase-receive', compact('purchase','data'));
    }
    public function generateSalesDeliver($id){
        $purchase = Sales::where('id', $id)->orderBy('id', 'asc')->first();
        
        $data = SlMovement::where('sl_movements.reference_id', $id)->where('sl_movements.reference_type_id', 2)
        ->join('sales', 'sales.id', 'sl_movements.reference_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'mast_item_groups.mast_item_category_id')
        ->select('sl_movements.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->orderBy('id', 'asc')->get();
       
        $pdf = PDF::loadView('layouts.pages.export.parsial-sales-delivery', compact('purchase','data'))->setPaper('a4', 'portrait');
        return $pdf->download('items6.pdf');
        // return view('layouts.pages.export.parsial-purchase-receive', compact('purchase','data'));
    }
    public function generateRequstionDeliver($id){
        $storeTransfer = StoreTransfer::where('id', $id)->orderBy('id', 'asc')->first();
        
        $data = SlMovement::where('sl_movements.reference_id', $id)->where('sl_movements.reference_type_id', 3)
        ->join('store_transfers', 'store_transfers.id', 'sl_movements.reference_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sl_movements.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'mast_item_groups.mast_item_category_id')
        ->select('sl_movements.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->orderBy('id', 'asc')->get();

       
        $pdf = PDF::loadView('layouts.pages.export.parsial-requstion-delivery', compact('storeTransfer','data'))->setPaper('a4', 'portrait');
        return $pdf->download('items6.pdf');
        // return view('layouts.pages.export.parsial-requstion-delivery', compact('storeTransfer','data'));
    }

}
