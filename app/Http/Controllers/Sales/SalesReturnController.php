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
        $data = Sales::whereIn('is_parsial', [1,3])->where('status', 1)->orderBy('id', 'asc')->get();

        return view('layouts.pages.sales.sales_return.index', compact('data'));
    }
    function getSalesDeliveryDetails(Request $request) {

        $data = SalesDetails::where('sales_details.sales_id', $request->id)
        ->join('sales', 'sales.id', 'sales_details.sales_id')
        ->join('mast_item_registers', 'mast_item_registers.id', 'sales_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('mast_item_categories', 'mast_item_categories.id', 'sales.mast_item_category_id')
        ->select('sales_details.*','sales.inv_no','sales.inv_date','mast_item_registers.part_no','mast_item_groups.part_name','mast_item_categories.cat_name')
        ->get();

        $store = MastWorkStation::where('id', Auth::user()->id)->first();
        $sales = Sales::where('sales.id', $request->id)->where('sales.status', 1)
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
