<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
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

class PurchaseController extends Controller
{
    public function index($type)
    {
        $item_group = MastItemGroup::where('mast_item_category_id', $type)->orderBy('part_name', 'asc')->get();
        $supplier=MastSupplier::where('status', 1)->get();
        $store=MastWorkStation::where('status', 1)->get();
        
        $data=Purchase::where('mast_item_category_id', $type)->where('status', 0)->with('purchaseDetails','mastWorkStation','mastSupplier')->orderBy('id', 'desc')->latest()->get();
        return view('layouts.pages.inventory.purchase.purchase',compact('type','item_group','supplier','store','data'));
    }
    public function store(Request $request, $type)
    {
        $purchase_codes = Helper::IDGenerator(new Purchase, 'inv_no', 5, 'INV-NO'); /* Generate id */
        
        $pur_id=$request->pur_id;
        if(isset($pur_id)){
            $storePurchase = Purchase::findOrFail($pur_id);
        }else{
            $validator = Validator::make($request->all(), [
                'inv_date' => 'required',
                'mast_supplier_id' => 'required',
                'mast_work_station_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $storePurchase = new Purchase();
            $storePurchase->inv_no = $purchase_codes;
        }
        $storePurchase->inv_date = $request->inv_date;
        $storePurchase->remarks = $request->remarks;
        $storePurchase->status = 0;
        $storePurchase->mast_item_category_id = $type;
        $storePurchase->mast_supplier_id = $request->mast_supplier_id;
        $storePurchase->mast_work_station_id = $request->mast_work_station_id;
        $storePurchase->user_id = Auth::user()->id;
        $storePurchase->save();

        if (isset($request->moreFile[0]['item_id']) && !empty($request->moreFile[0]['item_id'])) {
            foreach($request->moreFile as $item){
                $data = new PurchaseDetails();
                $data->mast_item_register_id = $item['item_id'];
                $data->qty = $item['qty'];
                $data->price = $item['price'];
                
                $data->status = 1;
                if(isset($pur_id)){
                    $data->purchase_id = $pur_id;
                }else{
                    $data->purchase_id = $storePurchase->id;
                }
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        // $purchase = Purchase::findOrFail($storePurchase->id)->with('mastWorkStation','mastSupplier')->first();
        if(isset($pur_id)){
            $purchase = Purchase::where('id', $pur_id)->first();
        }else{
            $purchase = Purchase::where('id', $storePurchase->id)->first();
        }
        $mastWorkStation = $purchase->mastWorkStation;
        $mastSupplier = $purchase->mastSupplier;
        $purchaseDetails = $purchase->purchaseDetails;

        $total = 0;
        foreach ($purchaseDetails as $key => $value) {
            $total += $value->qty * $value->price;
        }
        
        return response()->json([
            'storePurchase' => $storePurchase,
            'purchase' => $purchase,
            'mastWorkStation' => $mastWorkStation,
            'mastSupplier' => $mastSupplier,
            'total' => $total,
        ]);
    }
    public function edit(Request $request)
    {
        $supplier=MastSupplier::where('status', 1)->get();
        $store=MastWorkStation::where('status', 1)->get();
        
        $purchase_details = PurchaseDetails::where('purchase_id', $request->id)
        ->join('mast_item_registers', 'mast_item_registers.id', 'purchase_details.mast_item_register_id')
        ->join('mast_item_groups', 'mast_item_groups.id', 'mast_item_registers.mast_item_group_id')
        ->join('purchases', 'purchases.id', 'purchase_details.purchase_id')
        ->join('mast_units', 'mast_units.id', 'mast_item_registers.unit_id')
        ->select('purchase_details.*','mast_item_registers.part_no','mast_item_registers.box_qty','mast_units.unit_name','mast_item_groups.part_name')
        ->get();

        // $purchase_details =PurchaseDetails::with('mastItemRegister','purchase')->where('purchase_id', 1)->get();
        $data = Purchase::where('id', $request->id)->first();
        return response()->json([
            'data' => $data,
            'supplier' => $supplier,
            'store' => $store,
            'purchase_details' => $purchase_details,
        ]);
    }
    public function inv_purchase_destroy($id)
    {
        // InfoEducational::destroy($id);
        $data=PurchaseDetails::find($id);
        $data->delete();
        return response()->json('success');
    }

    //____________________Dropdwon Ajax____________________________//
    public function getPartNumber(Request $request)
    {
        $data = MastItemRegister::where('mast_item_group_id', $request->part_id)->get();
        return view('layouts.pages.inventory.purchase.load-part-number',compact('data'));
    }
    public function anotherField(Request $request)
    {
        $anotherField = MastItemRegister::where('id', $request->part_id)->with('unit')->first();
       
        return response()->json($anotherField);
    }

}

