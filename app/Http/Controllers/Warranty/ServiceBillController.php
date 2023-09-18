<?php

namespace App\Http\Controllers\Warranty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warranty\Complaint;
use App\Models\Warranty\JobCard;
use App\Models\Warranty\RequisitionDetails;
use App\Models\Master\MastItemRegister;
use App\Helpers\Helper;

class ServiceBillController extends Controller
{
    public function index()
    {
        $service = Complaint::get();
        $bill    = JobCard::all();
        $details = RequisitionDetails::with('mastItemRegister',)->with('mastItemRegister.unit')->with('mastItemRegister.mastItemGroup')->get();
        // dd($details);
        return view('layouts.pages.warranty.service_bill.index', compact('service','bill','details'));
    }
    public function getBill(Request $request)
    {
        $services = Complaint::where('id', $request->id)->get();
        dd($services);
        return response()->json([
            'services' => $services,
        ]);
    }

    public function calculateTotal(Request $request)
    {
        $quantity = floatval($request->input('qty'));
        $price = floatval($request->input('price'));
        
        $total = $quantity * $price;
        
        return response()->json(['total' => number_format($total, 2)]);
    }
}
