<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Branch;
use App\User;
use App\Branchuser;
use App\Cashier;
use App\Gastype;
use App\Pump;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    //
    public function addUser(Request $request)
    {
        $rules = array(
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                     'errors' => $validator->getMessageBag()->toArray(),
            ));

        } else {
            $data = new User();
            $data->name = strtoupper($request->fullname);
            $data->username = $request->username;
            $data->usertype = $request->usertype;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->save();

            $dataBranch = new Branchuser();
            $dataBranch->branchid = $request->branchid;
            $dataBranch->userid = $data->id;
            $dataBranch->status = 'active';
            $dataBranch->save();
            return response()->json($data);
        }
    }
    public function editUser(Request $req)
    {
        $data = User::find($req->id);
        $data->name = strtoupper($req->fullname);
        $data->username = $req->username;
        $data->email = $req->email;
        if(!empty($req->password)){
            $data->password = bcrypt($req->password);
        }
        
        $data->save();

        return response()->json($data);
    }
    public function deleteUser(Request $req)
    {
        User::find($req->id)->delete();
        $updateBranchuser = Cashier::where('userid', '=', $req->id)
                    ->delete();
        return response()->json();
    }
}
