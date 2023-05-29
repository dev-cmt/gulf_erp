<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\MastItemCategory;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastItemRegister;
use App\Models\MastUnit;
use App\Models\Inventory\Purchase;
use App\Models\Inventory\PurchaseDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;

class PurchaseController extends Controller
{
    public function index($type)
    {
        $partName = MastItemGroup::where('mast_item_category_id', $type)->get();
        $store=MastWorkStation::where('status', 1)->get();
        $purchase_inv=Purchase::where('inv_no')->get();
        return view('layouts.pages.inventory.purchase.purchase',compact('type','partName','store'));
    }

    public function storePurchase(Request $request)
    {
        $validated=$request -> validate([
            'inv_date' => 'date',
            'sup_id' => 'required',
            'store_id' => 'required',
            'out_time' => 'required',
        ]);

        $purchase_codes = Helper::IDGenerator(new Purchase, 'inv_no', 5, 'INV-NO'); /* Generate id */
        $storePurchase = new Purchase();
        $storePurchase->inv_date = $request->inv_date;
        $storePurchase->sup_id = $request->sup_id;
        $storePurchase->store_id = $request->store_id;
        $storePurchase->remarks = $request->remarks;
        $storePurchase->status = 1;
        $storePurchase->cat_id = 1;
        $storePurchase->inv_no = $purchase_codes;
        $storePurchase->user_id = Auth::user()->id;
        $storePurchase->save();
        
        foreach($request->moreFile as $item){
            if (isset ($item['item_id'])){
                $data = new PurchaseDetails();
                $data->item_id = $item['item_id'];
                $data->qty = $item['qty'];
                $data->price = $item['price'];
                
                $data->status = 1;
                $data->pur_id = $storePurchase->id;
                $data->user_id = Auth::user()->id;
                $data->save();
            }
        }
        $notification=array('messege'=>'AC Purchase save successfully!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function getPartNumber(Request $request)
    {
        $data = MastItemRegister::where('mast_item_group_id', $request->part_id)->get();
        return view('layouts.pages.inventory.purchase.load-part-number',compact('data'));
    }

    public function anotherField(Request $request)
    {
        $anotherField = MastItemRegister::where('id',$request->part_id)->with('unit')->first();
       
        return response()->json($anotherField);
    }

}
