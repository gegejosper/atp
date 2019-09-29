<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Branchuser;
use App\Gastype;
use App\Branchgases;
use App\Branchdipping;
use App\Pump;
use App\Product;
use App\Branchproduct;
use App\Branchcredit;
use App\Branchsale;
use App\Branchdiscount;
use App\Branchother;
use App\Pumplog;
use App\Account;
use App\Accountbill;
use App\Accountcredit;
use App\Pumprecord;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    //
    public function index(){
        if (Auth::check())
            {
                $userId = Auth::user()->id;
            }
            $dataBranch = Branchuser::where('userid', '=', $userId)->first();
    
        if(session()->has('sessionid')){

        }
        else {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $randomString .= ucwords($characters[rand(0, $charactersLength - 1)]);
            }
        
        session()->put('sessionid', $randomString);
        }
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
        $BranchId = $dataBranch->branchid;
        $dataBranch = Branch::get();
        $Branches = Branch::where('id','=', $BranchId)->get();
        $dataAccount = Account::where('branchid', '=', $BranchId)->get();
        $dataBranchgas = Branchgases::where('branchid', '=', $BranchId)->with('gas.branchpump', 'branchdipping')->get();
        $dataProduct = Branchproduct::where('branchid', '=', $BranchId)->with('product')->get();
        $dataGas = Gastype::get();
        // Pump Codes
        $dataPump = Pump::where('branchid', '=', $BranchId)->with('gastype', 'pumplog', 'pumploglastfinal')->get();
        $dataPumpReading = Pumprecord::where('branchid', '=', $BranchId)->take(10)->orderBy('created_at', 'desc')->get();
        $dataBranchgasPump = Branchgases::where('branchid', '=', $BranchId)->with('gas')->get();
        $dataBranchcredit = Branchcredit::where('creditstatus', '=', 'INITIAL')->where('creditsession', "=", session()->get('sessionid'))->get();
        $dataBranchsale = Branchsale::where('status', '=', 'INITIAL')->where('salesession', "=", session()->get('sessionid'))->get();
        $dataBranchdiscount = Branchdiscount::where('status', '=', 'INITIAL')->where('discountsession', "=", session()->get('sessionid'))->get();
        $dataBranchother = Branchother::where('status', '=', 'INITIAL')->where('descsession', "=", session()->get('sessionid'))->get();
        // end Pump Code
        //dd($dataBranchcredit);
        return view('billing.dashboard', compact('dataBranch', 'dataBranchgas', 'BranchId', 'Branches', 'dataBranchgasPump', 'dataPumpReading', 'dataPump','dataAccount', 'dataProduct', 'dataGas', 'dataBranchcredit', 'dataBranchdiscount', 'dataBranchsale', 'dataBranchother'));

    }
    public function billing(){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        $Branches = Branch::where('id','=', $BranchId)->get();
        $dataAccount = Account::where('branchid', '=', $BranchId)->get();
        //dd($dataAccount);
        return view('billing.bills', compact('dataBranch', 'Branches', 'dataAccount'));

    }
    public function account($accountId){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        $Branches = Branch::where('id','=', $BranchId)->get();
        $dataAccount = Account::where('id', '=', $accountId)->get();
        //dd($dataAccount);
        return view('billing.account', compact('dataBranch', 'Branches', 'dataAccount'));

    }
}
