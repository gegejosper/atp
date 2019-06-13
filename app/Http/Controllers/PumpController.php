<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gastype;
use App\Pump;
use App\User;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class PumpController extends Controller
{
    //
    public function addPump(Request $request)
    {
        $rules = array(
                'pumpname' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $data = new Pump();
            $data->pumpname = $request->pumpname;
            $data->gasid = $request->gasid;
            $data->branchid = $request->branchid;
            $data->save();

            return response()->json($data);
        }
    }
    public function editPump(Request $req)
    {
        $data = Pump::find($req->id);
        $data->pumpname = $req->pumpname;
        $data->volume = $req->volume; 
        $data->save();
        return response()->json($data);
    }
    public function deletePump(Request $req)
    {
        Pump::find($req->id)->delete();
        return response()->json();
    }
}
