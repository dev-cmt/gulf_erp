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
        
        // $data=Purchase::where('id', 1)->with('mastWorkStation','mastSupplier')->first();
        // dd($data->inv_date);


        $item_group = MastItemGroup::where('mast_item_category_id', $type)->get();
        $supplier=MastSupplier::where('status', 1)->get();
        $store=MastWorkStation::where('status', 1)->get();
        
        $data=Purchase::where('mast_item_category_id', $type)->where('status', 1)->with('mastWorkStation','mastSupplier')->get();
        return view('layouts.pages.inventory.purchase.purchase',compact('type','item_group','supplier','store','data'));
    }

    public function storePurchase(Request $request, $type)
    {
        $validator = Validator::make($request->all(), [
            'inv_date' => 'date',
            'mast_supplier_id' => 'required',
            'mast_work_station_id' => 'required',
        ]);
        if ($validator->fails()) {
            $notification=array('messege'=>'The validator failed.','alert-type'=>'fail');
            return back()->with($notification)->withErrors($validator)->withInput();
        }

        $purchase_codes = Helper::IDGenerator(new Purchase, 'inv_no', 5, 'INV-NO'); /* Generate id */
        $storePurchase = new Purchase();
        $storePurchase->inv_date = $request->inv_date;
        $storePurchase->remarks = $request->remarks;
        $storePurchase->status = 1;
        $storePurchase->inv_no = $purchase_codes;
        $storePurchase->mast_item_category_id = $type;
        $storePurchase->mast_supplier_id = $request->mast_supplier_id;
        $storePurchase->mast_work_station_id = $request->mast_work_station_id;
        $storePurchase->user_id = Auth::user()->id;
        $storePurchase->save();
        
        foreach($request->moreFile as $item){
            if (isset ($item['item_id'])){
                $data = new PurchaseDetails();
                $data->mast_item_register_id = $item['item_id'];
                $data->qty = $item['qty'];
                $data->price = $item['price'];
                
                $data->status = 1;
                $data->purchase_id = $storePurchase->id;
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        $notification=array('messege'=>'AC Purchase save successfully!','alert-type'=>'save');
        return redirect()->back()->with($notification);
    }
    public function store(Request $request)
    {
        $purchase_codes = Helper::IDGenerator(new Purchase, 'inv_no', 5, 'INV-NO');
        $todo = Purchase::updateOrCreate(
            ['id'=> $request->id],
            ['inv_date'=> $request->inv_date],
            ['mast_supplier_id'=> $request->mast_supplier_id],
            ['mast_work_station_id'=> $request->mast_work_station_id],
            ['inv_no'=> $purchase_codes],
            ['mast_item_category_id'=> 1],
            ['user_id'=> Auth::user()->id],
            ['remarks'=>$request->remarks]
        );
        return response()->json($todo);
    }
    //---View Attendance List
    public function getPurchaseDetails(Request $request, $id)
    {
        // $item_group = MastItemGroup::where('mast_item_category_id', $type)->get();
        // $supplier=MastSupplier::where('status', 1)->get();
        // $store=MastWorkStation::where('status', 1)->get();
        $data=Purchase::where('status', 1)->with('mastWorkStation','mastSupplier')->get();

        return view('layouts.pages.inventory.purchase.purchase-details-view', compact('data'));
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
