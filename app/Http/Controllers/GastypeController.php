<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gastype;
use App\Gaschange;
use App\Gasrecord;
use App\Branchgases;
use App\Branchdipping;
use App\User;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class GastypeController extends Controller
{
    public function addGastype(Request $request)
    {
        $rules = array(
                'gasname' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $data = new Gastype();
            $data->gasname = $request->gasname;
            $data->save();

            return response()->json($data);
        }
    }
    public function editGastype(Request $req)
    {
        $data = Gastype::find($req->id);
        $data->gasname = $req->gasname; 
        $data->save();
        return response()->json($data);
    }
    public function deleteGastype(Request $req)
    {
        Gastype::find($req->id)->delete();
        return response()->json();
    }

    public function addBranchGas(Request $req){
            $data = new Branchgases();
            $data->branchid = $req->branchid;
            $data->gasid = $req->gasid;
            $data->status = 'active';
            $data->save();

            $dataDipping = new Branchdipping();
            $dataDipping->dipvolume = 0;
            $dataDipping->dipopenvolume = 0;
            $dataDipping->dipclosevolume = 0;
            $dataDipping->deliveryvolume = 0;
            $dataDipping->gasid = $req->gasid;
            $dataDipping->type = 'INITIAL';
            $dataDipping->dippingdate = date('m-d-Y');
            $dataDipping->branchid = $req->branchid;
            $dataDipping->status = 'Final';
            $dataDipping->dippingsession = 'INITIAL';
            $dataDipping->save();
            return response()->json($data);
    }

    public function deleteBranchGas(Request $req)
    {
        Branchgases::find($req->id)->delete();
        return response()->json();
    }
    public function updateBranchGas(Request $req)
    {
        $dataBranchgas = Branchgases::find($req->id);
        
        $dataGasRecord = new Gasrecord();
        $dataGasRecord->branchgasid = $req->id;
        $dataGasRecord->gasid = $dataBranchgas->gasid;
        $dataGasRecord->branchid = $req->branchid;
        $dataGasRecord->oldprice = $dataBranchgas->price;
        $dataGasRecord->newprice = $req->price;
        $dataGasRecord->oldvolume = $dataBranchgas->volume;
        $dataGasRecord->newvolume = $req->volume;
        $dataGasRecord->save();
        
        $data = Branchgases::find($req->id);
        $data->volume = $req->volume; 
        $data->price = $req->price; 
        $data->save();
        $dataGaschange = new Gaschange();
        $dataGaschange->branchid = $req->branchid;
        $dataGaschange->branchgasid = $req->gasid;
        $dataGaschange->volumeedit = $req->volume;
        $dataGaschange->priceedit = $req->price;
        $dataGaschange->save();

        return response()->json($data);
    }
    public function updateBranchGasdashboard(Request $req)
    {
        $dataBranchgas = Branchgases::find($req->id);
        
        $dataGasRecord = new Gasrecord();
        $dataGasRecord->branchgasid = $req->id;
        $dataGasRecord->gasid = $dataBranchgas->gasid;
        $dataGasRecord->branchid = $req->branchid;
        $dataGasRecord->oldprice = $dataBranchgas->price;
        $dataGasRecord->newprice = $req->price;
        $dataGasRecord->oldvolume = $dataBranchgas->volume;
        $dataGasRecord->newvolume = $req->volume;
        $dataGasRecord->save();
        
        $data = Branchgases::find($req->id);
        $data->volume = $req->volume; 
        $data->price = $req->price; 
        $data->save();
        $data->gasname = $dataBranchgas->gas->gasname;
        $data->gasid = $dataBranchgas->gasid;
        $data->branchid = $req->branchid;
        $dataGaschange = new Gaschange();
        $dataGaschange->branchid = $req->branchid;
        $dataGaschange->branchgasid = $req->gasid;
        $dataGaschange->volumeedit = $req->volume;
        $dataGaschange->priceedit = $req->price;
        $dataGaschange->save();

        return response()->json($data);
    }
}

