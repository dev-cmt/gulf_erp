<?php

namespace App\Http\Controllers;

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

class ReportsController extends Controller
{
    /**___________________________________________________________________
     * Inventory
     * ___________________________________________________________________
     */
    public function purchaseReceive()
    {
        $data = Purchase::where('status', 3)->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.reports.purchase-recived',compact('data'));
    }
    public function salesDelivery()
    {
        $data= Sales::where('status', 1)->orderBy('id', 'asc')->get();
        return view('layouts.pages.inventory.sales_delivery.index',compact('data'));
    }
}
