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
        return view('layouts.pages.inventory.purchase_receive.receive_details',compact('data'));
    }
    public function grnPurchaseEdit(Request $request)
    {
        $data = PurchaseDetails::where('purchase_details.status', 1)->where('purchase_details.id', 1)
        ->join('purchases', 'purchases.id', 'purchase_details.purchase_id')
        ->join('mast_customers', 'mast_customers.id', 'purchases.mast_supplier_id')
        ->join('mast_work_stations', 'mast_work_stations.id', 'purchases.mast_work_station_id')
        ->select('purchase_details.*','purchases.inv_no','purchases.inv_date','mast_customers.name','mast_work_stations.store_name')
        ->first();
        return response()->json($data);
    }
}
