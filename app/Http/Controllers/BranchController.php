<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\User;
use App\Pump;
use App\Gastype;
use App\Branchgases;
use App\Customeraccount;
use App\Account;
use App\Cashier;
use App\Product;
use App\Branchproduct;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class BranchController extends Controller
{
    public function addBranch(Request $request)
    {
        $rules = array(
                'branch_name' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $data = new Branch();
            $data->branchname = $request->branch_name;
            $data->save();

            return response()->json($data);
        }
    }
    public function editBranch(Request $req)
    {
        $data = Branch::find($req->id);
        $data->branchname = $req->branch_name; 
        $data->save();
        return response()->json($data);
    }
    public function deleteBranch(Request $req)
    {
        Branch::find($req->id)->delete();
        return response()->json();
    }

    public function viewbranch($branchId)
    {
        $BranchId = $branchId;
        $dataBranch = Branch::where('id', '=', $branchId)->get();
        $dataPump = Pump::where('branchid', '=', $branchId)->get();
        $dataGastype = Gastype::get();
        return view('admin.branch', compact('dataBranch', 'dataPump', 'dataGastype', 'BranchId'));
        //return response()->json();
    }

    public function branchpump($branchId)
    {
        $BranchId = $branchId;
        $dataBranch = Branch::where('id', '=', $branchId)->get();
        $dataPump = Pump::where('branchid', '=', $branchId)->with('gastype')->get();
        
        $dataGastype = Gastype::get();
        //dd($dataPump);
        return view('admin.branch-pump', compact('dataBranch', 'dataPump', 'dataGastype', 'BranchId'));
        //return response()->json();
    }
    public function branchuser($branchId)
    {
        $BranchId = $branchId;
        $dataBranch = Branch::where('id', '=', $branchId)->get();
        $dataCashier = Cashier::where('branchid', '=', $branchId)->with('user')->get();
        return view('admin.branch-user', compact('dataBranch', 'dataCashier', 'BranchId'));
    }

    public function branchaccounts($branchId)
    {
        $BranchId = $branchId;
        $dataBranch = Branch::where('id', '=', $branchId)->get();
        $dataAccounts = Account::where('branchid', '=', $branchId)->get();
        return view('admin.branch-accounts', compact('dataBranch', 'dataAccounts', 'BranchId'));
    }

    public function branchgas($branchId)
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
        
        $dataBranchgas = Branchgases::where('branchid', '=', $BranchId)->with('gas.branchpump')->get();
        //dd($dataBranchgas);
        return view('admin.branch-gas', compact('dataBranch', 'dataGastype', 'BranchId', 'dataBranchgas', 'Gas'));
    }
    public function branchproduct($branchId)
    {
        $BranchId = $branchId;
        $dataBranch = Branch::where('id', '=', $branchId)->get();
        $dataProduct = Product::all();
        $Products = array();
        foreach($dataProduct as $Product){
            $ProductAvail= Branchproduct::where('branchid', '=', $BranchId)->where('productid', '=', $Product->id)->count();
            if($ProductAvail <= 0){
                array_push($Products, $Product);
            }
        }
        //dd($Gas);
        $dataBranchproducts = Branchproduct::where('branchid', '=', $BranchId)->with('product')->get();
        return view('admin.branch-product', compact('dataBranch', 'dataProduct', 'BranchId', 'dataBranchproducts', 'Products'));
    }

    
}
