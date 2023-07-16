<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Master\MastItemCategory;
use App\Models\Master\MastItemRegister;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastCustomer;
use App\Models\Sales\Sales;
use App\Models\Sales\SalesDetails;
class SalesReturnController extends Controller
{
    function salesReturnIndex() {
        $data = Sales::whereIn('status', [3])->whereIn('is_parsial', [0,1])->orderBy('id', 'asc')->get();
        return view('layouts.pages.sales.sales_return.index', compact('data'));
    }
    public function salesReturnDetails($id)
    {
        $sales = Sales::where('id', $id)->first();
        $store = MastWorkStation::where('id', Auth::user()->id)->first();
        $data = SalesDetails::where('sales_id', $id)->where('sales_details.status', 1)->where('sales_details.deli_qty','!=', 0)
        ->join('sales', 'sales.id', 'sales_details.sales_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sales_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'sales.mast_item_category_id')
        ->select('sales_details.*','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->get();
        
        return view('layouts.pages.sales.sales_return.return_details', compact('data','sales','store'));
    }
    /**___________________________________________________________________
     * Ajax Get Data & Show
     * ___________________________________________________________________
     */
    function getSalesDeliveryDetails(Request $request) {

        $data = SalesDetails::where('sales_details.sales_id', $request->id)
        ->join('sales', 'sales.id', 'sales_details.sales_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sales_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'sales.mast_item_category_id')
        ->select('sales_details.*','sales.inv_no','sales.inv_date','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->get();

        $store = MastWorkStation::where('id', Auth::user()->id)->first();
        $sales = Sales::where('sales.id', $request->id)
        ->join('mast_customers', 'mast_customers.id', 'sales.mast_customer_id')
        ->select('sales.*','mast_customers.name')
        ->first();
        return response()->json([
            'data' => $data,
            'sales' => $sales,
            'store' => $store->store_name,
        ]);
    }
}
