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
    public function purchase_grn()
    {
        $data=PurchaseDetails::where('status', 0)->orderBy('id', 'desc')->get();
        return view('layouts.pages.inventory.purchase_receive',compact('data'));
    }
    public function getPurchaseGRN($id)
    {
        $data=PurchaseDetails::where('status', 0)->orderBy('id', 'desc')->get();
        return view('layouts.pages.inventory.purchase_receive',compact('data'));
    }
}
