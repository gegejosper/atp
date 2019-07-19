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
        
        if(session()->has('dippingId')){

        }
        else {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $randomString .= ucwords($characters[rand(0, $charactersLength - 1)]);
            }
        
        session()->put('dippingId', $randomString);
        }
        $BranchId = $branchId;
        $dataBranch = Branch::get();
        $Branches = Branch::where('id','=', $BranchId)->get();
        $dataGastype = Gastype::with('branchpump')->get();
        $Gas = array();
        foreach($dataGastype as $gastype){
            $BranchGasAvail= Branchgases::where('branchid', '=', $BranchId)->where('gasid', '=', $gastype->id)->count();
            if($BranchGasAvail <= 0){
                array_push($Gas, $gastype);
            }
        }
        $dippingDate = Branchdipping::where('dippingdate', '=', date('m-d-Y'))->where('status', '=', 'Initial')->with('gas')->get();
        
        $dataBranchgas = Branchgases::where('branchid', '=', $BranchId)->with('gas.branchpump', 'branchdipping')->get();
        //dd($dataBranchgas);
        $getDataBranchgas = Branchgases::where('branchid', '=', $BranchId)->with('gas')->get();

        $BranchGasDipping= Branchdipping::where('branchid', '=', $BranchId)->where('status', '=', 'Final')->with('gas')->orderBy('created_at', 'desc')->get();

        return view('admin.branch-dipping', compact('dataBranch', 'dataGastype', 'BranchId', 'dataBranchgas', 'Gas', 'dippingDate', 'BranchGasDipping', 'Branches'));
    }
    public function saveBranchDipping ($branchid){
        $BranchId = $branchid;
        $getDipping = Branchdipping::where('dippingdate', '=', date('m-d-Y'))->where('status', '=', 'Initial')->get();
        foreach ($getDipping as $Dipping) {
            $getDataBranchgas = Branchgases::where('branchid', '=', $BranchId)->where('gasid', '=', $Dipping->gasid)->latest()
            ->first();
            $updateGasBranch = Branchgases::where('id', '=', $getDataBranchgas->id)
                ->update(['volume' => $Dipping->dipclosevolume]);
        }
        $updateDipping = Branchdipping::where('dippingsession', '=', session()->get('dippingId'))->where('status', '=', 'Initial')
                ->update(['status' => 'Final']);
        //dd($updateDipping);
        
        session()->forget('dippingId');
        return redirect()->back()->with('success', 'Dipping successfully saved!');
    }
    
    public function addBranchDipping(Request $request)
    {
        $rules = array(
                'dipopenvolume' => 'required',
                'dipclosevolume' => 'required',

        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            
            $data = new Branchdipping();
            $dipvolume = ($request->dipopenvolume - $request->dipclosevolume) + $request->deliveryvolume; 
            $data->dipvolume = round($dipvolume, 2);
            $data->dipopenvolume = $request->dipopenvolume;
            $data->dipclosevolume = $request->dipclosevolume;
            $data->deliveryvolume = $request->deliveryvolume;
            $data->gasid = $request->gasid;
            $data->type = 'Dipping';
            $data->dippingdate = $request->dippingdate;
            $data->branchid = $request->branchid;
            $data->status = 'Initial';
            $data->dippingsession = session()->get('dippingId');
            $data->save();
            $data->gasname = $request->gasname;

            return response()->json($data);
        }
    }
    public function deleteBranchDipping(Request $req)
    {
        Branchdipping::find($req->id)->delete();
        return response()->json();
    }
}
