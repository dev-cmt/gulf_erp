<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\MastItemCategory;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastItemRegister;
use App\Models\Master\MastUnit;
use App\Models\Master\MastSupplier;
use App\Models\Master\MastCustomer;
use App\Models\Master\MastCustomerType;
use App\Models\Sales\Sales;
use App\Models\Sales\SalesDetails;
use App\Helpers\Helper;

class SalesController extends Controller
{
    public function index($type)
    {
        $item_group = MastItemGroup::where('mast_item_category_id', $type)->orderBy('part_name', 'asc')->get();
        $customer = MastCustomer::where('status', 1)->where('mast_customer_type_id', $type)->get();
        $customer_type = MastCustomerType::where('status', 1)->get();
        $item_category = MastItemCategory::where('status', 1)->get();
        
        $data=Sales::where('mast_item_category_id', $type)->where('status', 0)->with('salesDetails','mastCustomer','mastItemCategory')->orderBy('id', 'desc')->latest()->get();
        return view('layouts.pages.sales.sales',compact('type','data','item_group','customer','customer_type','item_category'));
    }
    public function store(Request $request, $type)
    {
        $invoice_codes = Helper::IDGenerator(new Sales, 'inv_no', 5, 'INV-NO'); /* Generate id */
        
        $sal_id=$request->sal_id;
        if(isset($sal_id)){
            $sales = Sales::findOrFail($sal_id);
        }else{
            $validator = Validator::make($request->all(), [
                'inv_date' => 'required',
                'mast_customer_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $sales = new Sales();
            $sales->inv_no = $invoice_codes;
        }
        $sales->inv_date = $request->inv_date;
        $sales->vat = $request->vat;
        $sales->tax = $request->tax;
        $sales->remarks = $request->remarks;
        $sales->status = 0;
        $sales->mast_item_category_id = $type;
        $sales->mast_customer_id = $request->mast_customer_id;
        $sales->user_id = Auth::user()->id;
        $sales->save();

        if (isset($request->moreFile[0]['item_id']) && !empty($request->moreFile[0]['item_id'])) {
            foreach($request->moreFile as $item){
                $data = new SalesDetails();
                $data->mast_item_register_id = $item['item_id'];
                $data->qty = $item['qty'];
                $data->price = $item['price'];
                
                $data->status = 1;
                if(isset($sal_id)){
                    $data->sales_id = $sal_id;
                }else{
                    $data->sales_id = $sales->id;
                }
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        if(isset($sal_id)){
            $new_sales = Sales::where('id', $sal_id)->first();
        }else{
            $new_sales = Sales::where('id', $sales->id)->first();
        }
        $mastCustomer = $new_sales->mastCustomer;
        $mastItemCategory = $new_sales->mastItemCategory;
        $salesDetails = $new_sales->salesDetails;

        $total = 0;
        foreach ($salesDetails as $key => $value) {
            $total += $value->qty * $value->price;
        }

        return response()->json([
            'sales' => $sales,
            'mastCustomer' => $mastCustomer,
            'mastItemCategory' => $mastItemCategory,
            'total' => $total,
        ]);
    }
    public function edit(Request $request)
    {
        $sales_details = SalesDetails::where('sales_id', $request->id)
        ->join('mast_item_registers', 'mast_item_registers.id', 'sales_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('sales', 'sales.id', 'sales_details.sales_id')
        ->join('mast_units', 'mast_units.id', 'mast_item_registers.unit_id')        
        ->select('sales_details.*','mast_item_registers.part_no','mast_item_registers.box_qty','mast_units.unit_name','mast_item_groups.part_name')
        ->get();

        
        $customer_type = MastCustomerType::where('status', 1)->get();
        $customer_type_id = Sales::where('sales.id', $request->id)
        ->join('mast_customers', 'mast_customers.id', 'sales.mast_customer_id')
        ->join('mast_customer_types', 'mast_customer_types.id', 'mast_customers.mast_customer_type_id')
        ->select('mast_customer_types.id')
        ->first();
        $customer = MastCustomer::where('status', 1)->where('mast_customer_type_id', $customer_type_id->id)->get();
        
        $data=Sales::where('id', $request->id)->first();
        return response()->json([
            'data' => $data,
            'customer' => $customer,
            'customer_type' => $customer_type,
            'customer_type_id' => $customer_type_id,
            'sales_details' => $sales_details,
        ]);
    }
    public function sales_destroy($id)
    {
        $data=SalesDetails::find($id);
        $subTotal = $data->qty*$data->price;
        $data->delete();
        return response()->json($subTotal);
    }
    public function getSalesDetails(Request $request)
    {
        // $data=SalesDetails::find($request->id);
        return response()->json($subTotal);
    }
    //---------------------------------------
    //-----------------DISTRIBUTOR
    //---------------------------------------
    public function indexCustomer($type)
    {
        $distributorList = MastCustomer::where('mast_customer_type_id', $type)->get();
        return view('layouts.pages.master.customer.index',compact('distributorList','type'));
    }

    public function createCustomer($type)
    {
        return view('layouts.pages.master.customer.create',compact('type'));
    }

    public function storeCustomer(Request $request)
    {
        $validated=$request -> validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $data = new MastCustomer();
        $data->name = $request->name;
        $data->address = $request->address;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->cont_designation = $request->cont_designation;
        $data->cont_person = $request->cont_person;
        $data->cont_phone = $request->cont_phone;
        $data->cont_email = $request->cont_email;
        $data->web_address = $request->web_address;
        $data->credit_limit = $request->credit_limit;
        $data->remarks = $request->remarks;
        $data->mast_customer_type_id = $request->mast_customer_type_id;
        $data->status = 1;
        $data->user_id = Auth::user()->id;
        $data->save();

        $notification = array('messege' => 'Distributor create save successfully.', 'alert-type' => 'success');
        return redirect()->route("customer.index", ['cat_id' => $request->mast_customer_type_id])->with($notification);
    }


    //-----------------------------------------
    public function getCustomerData(Request $request)
    {
        $data = MastCustomer::where('status', 1)->where('mast_customer_type_id', $request->part_id)->get();
        return view('layouts.pages.sales.load-customer',compact('data'));
    }
}
