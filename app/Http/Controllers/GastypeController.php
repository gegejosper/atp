<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gastype;
use App\Branchgases;
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

            return response()->json($data);
    }

    public function deleteBranchGas(Request $req)
    {
        Branchgases::find($req->id)->delete();
        return response()->json();
    }
    public function updateBranchGas(Request $req)
    {
        $data = Branchgases::find($req->id);
        $data->volume = $req->volume; 
        $data->price = $req->price; 
        $data->save();
        return response()->json($data);
    }
}

