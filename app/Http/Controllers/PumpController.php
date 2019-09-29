<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gastype;
use App\Pump;
use App\Pumplog;
use App\Pumprecord;
use App\User;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

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

    public function savepumplog (Request $req) {
        if (Auth::check())
            {
                $userId = Auth::user()->id;
            }
        for($i = 0; $i < count($req->pumpid); $i++){
            $data = new Pumplog();
            $data->branchid = $req->branchid;
            $data->gasid = $req->gasid[$i]; 
            $data->userid = $userId;
            $data->logsession = 'ADMIN';
            $data->pumpid = $req->pumpid[$i];
            $data->consumevolume = $req->consumevolume[$i]; 
            $data->openvolume = $req->openvolume[$i];
            $data->closevolume = $req->closevolume[$i]; 
            $data->unitprice = $req->unitprice[$i];
            $data->amount = $req->amount[$i]; 
            $data->batchcode = session()->get('batchcode'); 
            $data->datelog = date('m-d-Y');
            $data->status = 'Final';
            $data->save();

           
        } 
        $dataPumprecord = new Pumprecord();
        $dataPumprecord->branchid = $req->branchid;
        $dataPumprecord->batchcode = session()->get('batchcode'); 
        $dataPumprecord->readingdate =  date('m-d-Y');
        $dataPumprecord->save();
        session()->forget('batchcode');
        return redirect()->back()->with('success','Daily log successfully recorded!');
    }
}
