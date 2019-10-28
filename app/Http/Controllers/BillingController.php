<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Branchuser;
//use Carbon\Carbon;
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
        //$dataAccount = Account::where('branchid', '=', $BranchId)->get();
        $accountBill = Accountbill::where('branchid', '=', $BranchId)->with('account')->latest()->get();  
        //dd($dataAccount);
        return view('billing.bills', compact('dataBranch', 'Branches', 'accountBill'));

    }
    public function viewbill($billid){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        $Branches = Branch::where('id','=', $BranchId)->get();
        $accountBill = Accountbill::where('id', '=', $billid)->with('account')->take(1)->get();
        foreach($accountBill as $dataBill) {
            $daterange = explode('-', $dataBill->billdate); 
            $fromDate = trim(str_replace('/', '-', $daterange[0]));
            $toDate = trim(str_replace('/', '-', $daterange[1]));
            $dataCredit = Branchcredit::where('creditdate', '>=', $fromDate)
            ->where('creditdate', '<=', $toDate)->where('creditstatus', '=', 'FINAL')->get();
        }  
        $dataAccount = Account::where('id', '=', $BranchId)->get();
         
        //dd($dataCredit);
        return view('billing.bill', compact('dataBranch', 'Branches', 'accountBill', 'billid', 'dataCredit'));

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
        $recentBill = Accountbill::where('accountid', '=', $accountId)->where('billstatus', '=', 'not paid')->latest()->get(); 
        $historyBill = Accountbill::where('accountid', '=', $accountId)->where('billstatus', '=', 'paid')->latest()->get(); 
        //dd($dataAccount);
        return view('billing.account', compact('dataBranch', 'Branches', 'dataAccount', 'recentBill', 'historyBill'));

    }
    public function generatebill(Request $req){
        $daterange = explode('-', $req->billdate); 
        $fromDate = trim(str_replace('/', '-', $daterange[0]));
        $toDate = trim(str_replace('/', '-', $daterange[1]));
        //dd($fromDate , '-', $toDate);
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        $dataAccount = Account::where('branchid', '=', $BranchId)->get();
        $accountData = array();
        foreach($dataAccount as $Account){
            $accountCredits = Accountcredit::where('accountid', '=', $Account->id)
                ->where('creditdate', '>=', $fromDate)
                ->where('creditdate', '<=', $toDate)
                ->get();
            $totalAmount = 0;
            $totalQuantity = 0;
            foreach($accountCredits as $Credit){
                $totalAmount = $totalAmount + $Credit->amount;
                if($Credit->credittype == 'Petrol'){
                    $totalQuantity = $totalQuantity + $Credit->quantity;
                }
                
            }
            $discountedAmount = $totalAmount - $totalQuantity;
            //$discountedAmount = $totalAmount - $totalQuantity;
            $accountDetails = array($Account->id,$Account->fname, $Account->lname,  $totalAmount, $discountedAmount, $totalQuantity);
            array_push($accountData,$accountDetails);
        }
        $countPrevBill = Accountbill::where('accountid', '=', $Account->id)->where('billstatus', '=', 'not paid')->get();
        $prevBillAmount = 0;
        foreach($countPrevBill as $PrevBill){
            $prevBillAmount = $PrevBill->totalamount;
        }     
        foreach($accountData as $Data){
            $countBill = Accountbill::where('accountid', '=', $Data[0])->count();     
            $data = new Accountbill();
            $data->billnum  = $countBill+1;
            $data->billdate  = $req->billdate;
            $data->balance = $Data[4];
            $data->discount  = $Data[5];
            $data->amount  = $Data[3];
            $data->billstatus  = 'not paid';
            $data->accountid  = $Data[0];
            $data->branchid  = $BranchId;
            $data->userid = $userId;
            $data->totalamount = $Data[4];
            $data->prevbal = $prevBillAmount;
            $data->save();
        }
        //dd($accountData);
        return redirect()->back()->with('success','Bill successfully generated for '. $req->billdate.'.');
        // $fromdate = Carbon::parse($fromDate.' 00:00:00');
        // $todate = Carbon::parse($toDate .' 23:59:59'); 

    }
    
}
