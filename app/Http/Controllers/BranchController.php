<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\User;
use App\Pump;
use App\Pumplog;
use App\Pumprecord;
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
        $dataBranch = Branch::get();
        $Branches = Branch::where('id','=', $BranchId)->get();
        $dataPump = Pump::where('branchid', '=', $branchId)->get();
        $dataGastype = Gastype::get();
        return view('admin.branch', compact('dataBranch', 'dataPump', 'dataGastype', 'BranchId', 'Branches'));
        //return response()->json();
    }

    public function branchpump($branchId)
    {
        
        if(session()->has('batchcode')){

        }
        else {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $randomString .= ucwords($characters[rand(0, $charactersLength - 1)]);
            }
        
        session()->put('batchcode', $randomString);
        }
        $BranchId = $branchId;
        $dataBranch = Branch::get();
        $Branches = Branch::where('id','=', $BranchId)->get();
        $dataPump = Pump::where('branchid', '=', $branchId)->with('gastype', 'pumplog')->get();
        
        //$dataPumpRecord = Pumplog::where('branchid', '=', $branchId)->groupBy('gasid')->get();
        $dataPumpReading = Pumprecord::where('branchid', '=', $branchId)->take(10)->orderBy('created_at', 'desc')->get();
        //$dataPumplogs = Pumplog::where('branchid', '=', $branchId)->groupBy('batchcode')->get();
        $dataGastype = Gastype::get();
        $dataBranchgas = Branchgases::where('branchid', '=', $BranchId)->with('gas')->get();
        //dd($dataPumpReading);
        return view('admin.branch-pump', compact('dataBranch', 'dataPump', 'dataGastype', 'BranchId', 'dataBranchgas','dataPumpReading', 'Branches'));
        //return response()->json();
    }
    public function viewpumpreading($branchid,$batchcode)
    {
        $BranchId = $branchid;
        $dataBranch = Branch::get();
        $Branches = Branch::where('id','=', $BranchId)->get();
           //$dataPumpRecord = Pumplog::where('branchid', '=', $branchId)->groupBy('gasid')->get();
        $dataPump = Pump::where('branchid', '=', $BranchId)->with('gastype', 'pumplog')->get();
        $dataPumpReading = Pumprecord::where('branchid', '=', $BranchId)->take(10)->orderBy('created_at', 'desc')->get();
        $dataPumplogs = Pumplog::where('batchcode', '=', $batchcode)->with('pump')->get();
        $dataGastype = Gastype::get();
        $dataBranchgas = Branchgases::where('branchid', '=', $BranchId)->with('gas')->get();
        //dd($dataPumplogs);
        return view('admin.branch-pump-record', compact('dataBranch', 'dataPump', 'dataGastype', 'BranchId', 'dataBranchgas','dataPumpReading','dataPumplogs', 'Branches'));
        //return response()->json();
    }

    
    public function branchuser($branchId)
    {
        $BranchId = $branchId;
        $dataBranch = Branch::get();
        $Branches = Branch::where('id','=', $BranchId)->get();
        $dataCashier = Cashier::where('branchid', '=', $branchId)->with('user')->get();
        return view('admin.branch-user', compact('dataBranch', 'dataCashier', 'BranchId', 'Branches'));
    }

    public function branchaccounts($branchId)
    {
        $BranchId = $branchId;
        $dataBranch = Branch::get();
        $Branches = Branch::where('id','=', $BranchId)->get();
        $dataAccounts = Account::where('branchid', '=', $branchId)->get();
        return view('admin.branch-accounts', compact('dataBranch', 'dataAccounts', 'BranchId', 'Branches'));
    }

    public function branchgas($branchId)
    {
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
        
        $dataBranchgas = Branchgases::where('branchid', '=', $BranchId)->with('branchpump')->get();
        //dd($dataBranchgas);
        return view('admin.branch-gas', compact('dataBranch', 'dataGastype', 'BranchId', 'dataBranchgas', 'Gas', 'Branches'));
    }
    public function branchproduct($branchId)
    {
        $BranchId = $branchId;
        $dataBranch = Branch::get();
        $Branches = Branch::where('id','=', $BranchId)->get();
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
        return view('admin.branch-product', compact('dataBranch', 'dataProduct', 'BranchId', 'dataBranchproducts', 'Products', 'Branches'));
    }

    
}
