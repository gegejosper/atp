<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Purchaserecord;
use App\Branch;
use App\Branchgases;
use App\Gastype;



class PurchaseController extends Controller
{
    //
    public function createpurchase(Request $request)
    {
       
            $data = new Purchase();
            $data->purchasenumber = $request->purchasenumber;
            $data->date = $request->purchasedate;
            $data->branch_id = $request->branch;
            $data->status = 'initial';
            $data->save();
            return redirect('admin/order/createpurchase/'.$request->purchasenumber.'/'.$request->branch);
            //return response()->json($data);
    }

    public function createpurchaserequest($purnumber, $branchid)
    {
        
        $dataBranch = Branch::get();
        $purchasenumber = $purnumber;
        $BranchId = $branchid;
        $dataPurchaseRecord = Purchaserecord::where('purchasenumber','=',$purchasenumber)
                                ->with('gasdetail')
                                ->get();
        $Gas= Branchgases::where('branchid', '=', $BranchId)->with('gas')->get();

        return view('admin.createpurchase',compact('purchasenumber', 'dataPurchaseRecord', 'dataBranch', 'Gas')); 
    }
    public function addquantityrequest(Request $request)
    {
        $data = new Purchaserecord();
        $data->purchasenumber = $request->purchasenumber;
        $data->date = $request->date;
        $data->quantity = $request->quantity;
        $data->itemid = $request->itemid;
        $data->status = 'initial';
        $data->save();
        return response()->json();
    }
}
