<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\User;
use App\Pump;
use App\Gastype;
use App\Branchgases;
use App\Cashier;
use App\Product;
use App\Branchproduct;
use App\Branchdipping;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class DippingController extends Controller
{
    //
    public function branchdipping($branchId)
    {
        $BranchId = $branchId;
        $dataBranch = Branch::where('id', '=', $branchId)->get();
        $dataGastype = Gastype::with('branchpump')->get();
        $Gas = array();
        foreach($dataGastype as $gastype){
            $BranchGasAvail= Branchgases::where('branchid', '=', $BranchId)->where('gasid', '=', $gastype->id)->count();
            if($BranchGasAvail <= 0){
                array_push($Gas, $gastype);
            }
        }
        $dippingDate = Branchdipping::where('dippingdate', '=', date('m-d-Y'))->where('status', '=', 'Initial')->with('gas')->get();
        if(count($dippingDate) == 0) {
            $type = 'Open';
        }
        else {
            $type = "Close";
        }
        $dataBranchgas = Branchgases::where('branchid', '=', $BranchId)->with('gas.branchpump')->get();
        //dd($dippingDate);
        return view('admin.branch-dipping', compact('dataBranch', 'dataGastype', 'BranchId', 'dataBranchgas', 'Gas', 'type', 'dippingDate'));
    }

    public function addBranchDipping(Request $request)
    {
        $rules = array(
                'dipvolume' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $data = new Branchdipping();
            $data->dipvolume = $request->dipvolume;
            $data->gasid = $request->gasid;
            $data->type = $request->dippingtype;
            $data->dippingdate = $request->dippingdate;
            $data->branchid = $request->branchid;
            $data->status = 'Initial';
            $data->save();
            $data->gasname = $request->gasname;

            return response()->json($data);
        }
    }
}
