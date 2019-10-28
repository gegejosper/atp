<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Branchuser;
use App\Gastype;
use App\Branchgases;
use App\Branchdipping;
use App\Branchreport;
use App\Pump;
use App\Product;
use App\Branchproduct;
use App\Branchcredit;
use App\Branchsale;
use App\Branchdiscount;
use App\Branchother;
use App\Branchpayment;
use App\Pumplog;
use App\Account;
use App\Accountbill;
use App\Accountcredit;
use App\Pumprecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class InchargeController extends Controller
{
    //
    public function branchaccount(){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
    }
    public function index()
    {
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
        return view('incharge.dashboard', compact('dataBranch', 'dataBranchgas', 'BranchId', 'Branches', 'dataBranchgasPump', 'dataPumpReading', 'dataPump','dataAccount', 'dataProduct', 'dataGas', 'dataBranchcredit', 'dataBranchdiscount', 'dataBranchsale', 'dataBranchother'));
    }

    public function dipping()
    {
        $dataBranch = Branch::get();
        return view('incharge.dipping', compact('dataBranch'));
    }
    public function accounts()
    {
        
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        $Branches = Branch::where('id','=', $BranchId)->get();
        $dataAccount = Account::where('branchid', '=', $BranchId)->get();
        $accountBill = Accountbill::where('branchid', '=', $BranchId)->with('account')->latest()->get();  
        //dd($dataAccount);
        return view('incharge.accounts', compact('dataBranch', 'Branches', 'accountBill', 'dataAccount'));
        
    }
    public function searchaccount (Request $request){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        if($request->ajax())
        {
            $dataAccount = Account::where('fname','LIKE','%'.$request->search."%")
                ->orWhere('lname','LIKE','%'.$request->search."%")
                ->orWhere('mname','LIKE','%'.$request->search."%")
                ->orWhere('address','LIKE','%'.$request->search."%")
                ->latest()
                ->get();
            $output="";
            if($dataAccount)
            { 
                foreach ($dataAccount as $key => $Account) {
                    if($Account->branchid == $BranchId){
                        $output.='<tr>
                        <td><a href="/incharge/account/'.$Account->id.'">'.$Account->id.'</a></td>
                        <td>'.ucwords($Account->lname).', '.ucwords($Account->fname).' '.ucwords($Account->mname).'</td>
                        <td>'.ucwords($Account->address).'</td>
                        <td>'.ucwords($Account->contactnum).'</td>
                        <td class="td-actions">
                        <a href="/incharge/account/'.$Account->id.'" class="btn btn-info btn-small"><i class="fa fa-search"></i></a>
                        </td>
                        ';
                        $output .='</tr>';
                    }   
                }
                return Response($output);
            }
        }
    }
    public function pumps()
    {
        $dataBranch = Branch::get();
        return view('incharge.pumps', compact('dataBranch'));
    }
    public function report()
    {
        $dataBranch = Branch::get();
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranchUser = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranchUser->branchid;
        $dataBranchReport = Branchreport::where('branchid', '=', $BranchId)->get();
        return view('incharge.report', compact('dataBranch', 'dataBranchReport'));
    }

    

    public function submitreport (Request $req) {
        
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        for($i = 0; $i < count($req->pumpid); $i++){
            $data = new Pumplog();
            $data->branchid = $req->branchid;
            $data->userid = $userId; 
            $data->logsession = session()->get('sessionid');
            $data->gasid = $req->gasid[$i]; 
            $data->pumpid = $req->pumpid[$i];
            $data->consumevolume = $req->consumevolume[$i]; 
            $data->openvolume = $req->openvolume[$i];
            $data->closevolume = $req->closevolume[$i]; 
            $data->unitprice = $req->unitprice[$i];
            $data->amount = $req->amount[$i]; 
            $data->batchcode = session()->get('batchcode'); 
            $data->datelog = date('m-d-Y');
            $data->status = 'Initial';
            $data->save();          
        } 
        $dataPumprecord = new Pumprecord();
        $dataPumprecord->branchid = $req->branchid;
        $dataPumprecord->batchcode = session()->get('batchcode'); 
        $dataPumprecord->readingdate =  date('m-d-Y');
        $dataPumprecord->save();
        session()->forget('batchcode');

        
        return redirect('/incharge/dashboard/submit-report/check');
        
    }
    public function checkreport(){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        $dataBranch = Branch::get();
        $Branches = Branch::where('id','=', $BranchId)->get();
        
        $dataBranchcredit = Branchcredit::where('creditstatus', '=', 'INITIAL')->where('creditsession', "=", session()->get('sessionid'))->get();
        $dataBranchsale = Branchsale::where('status', '=', 'INITIAL')->where('salesession', "=", session()->get('sessionid'))->get();
        $dataBranchdiscount = Branchdiscount::where('status', '=', 'INITIAL')->where('discountsession', "=", session()->get('sessionid'))->get();
        $dataBranchother = Branchother::where('status', '=', 'INITIAL')->where('descsession', "=", session()->get('sessionid'))->get();
        $dataPumplog = Pumplog::where('logsession', "=", session()->get('sessionid'))->get();
        $logsession = session()->get('sessionid');
        
        $dataGas = Gastype::get();
        $arrayGas = array();
        foreach($dataGas as $Gastypes){
            $dataGasPumplog = Pumplog::where('gasid', '=', $Gastypes->id)->where('logsession', "=", session()->get('sessionid'))->get();
            $volume =0;
            $price = 0;
            foreach($dataGasPumplog as $Pumplog){
                $volume = $volume + $Pumplog->consumevolume;
                $price = $Pumplog->unitprice;
            }
            $gassummary = array($Gastypes->gasname, $volume, $price);
            array_push($arrayGas, $gassummary);
        }
        //dd($arrayGas);
        return view('incharge.checksubmit', compact('dataBranch', 'BranchId', 'Branches', 'dataPumplog', 'dataBranchcredit', 'dataBranchdiscount', 'dataBranchsale', 'dataBranchother', 'logsession', 'arrayGas'));
        //return view('incharge.checksubmit', compact('dataBranch'));   
    }
    public function reportsave($logsession){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        $dataBranch = Branch::get();
        $Branches = Branch::where('id','=', $BranchId)->get();
        
        $Branchcredit = Branchcredit::where('creditsession', '=', $logsession)->get();
        foreach($Branchcredit as $credit) {

            $creditid = explode(",",$credit->account);
            $product = explode(",",$credit->gasname);
            $data = new Accountcredit();
            $data->creditdate  = $credit->creditdate;
            $data->accountid  = $creditid[2];
            $data->invoicenum  = $credit->invoice;
            $data->quantity  = $credit->liters;
            $data->product  = trim($product[1]);
            $data->unitprice  = $credit->unitprice;
            $data->amount  = $credit->amount;
            $data->platenumber  = $credit->creditplatenum;
            $data->credittype  = 'Petrol';
            $data->save();
        }
        $Branchsale = Branchsale::where('salesession', '=', $logsession)->get();
        foreach($Branchsale as $sale) {

            $creditid = explode(",",$sale->account);
            if($creditid[2] != 0) {
                $product = explode(",",$sale->product);
                $data = new Accountcredit();
                $data->creditdate  = $sale->saledate;
                $data->accountid  = $creditid[2];
                $data->invoicenum  = $sale->invoice;
                $data->quantity  = $sale->quantity;
                $data->product  = trim($product[1]);
                $data->unitprice  = $sale->price;
                $data->amount  = $sale->amount;
                $data->platenumber  = 'n/a';
                $data->credittype  = 'Product';
                $data->save();
            }
            
        }
        
        $updateBranchcredit = Branchcredit::where('creditsession', '=', $logsession)
                    ->update(['creditstatus' => 'FINAL']);
        $updateBranchsale = Branchsale::where('salesession', '=', $logsession)
                    ->update(['status' => 'FINAL']);
        $updateBranchdiscount = Branchdiscount::where('discountsession', '=', $logsession)
                    ->update(['status' => 'FINAL']);
        $updateBranchother = Branchother::where('descsession', '=', $logsession)
                    ->update(['status' => 'FINAL']);
        $updatePumplog = Pumplog::where('logsession', '=', $logsession)
                    ->update(['status' => 'FINAL']);
        
        $dataReport = new Branchreport();
        $dataReport->reportdate = date('m-d-y');
        $dataReport->sessionrecord = $logsession;
        $dataReport->branchid = $BranchId;
        $dataReport->userid = $userId;
        $dataReport->save();
        session()->forget('sessionid');
        return redirect('/incharge/daily-report/'.$logsession);
        //return view('incharge.printreport', compact('dataBranch', 'BranchId', 'Branches', 'dataBranchgasPump', 'dataPumpReading', 'dataPumplog', 'dataBranchcredit', 'dataBranchdiscount', 'dataBranchsale', 'dataBranchother'));
    }
    public function backdashboard(){
        $delete = Pumplog::where('logsession', '=', session()->get('sessionid'))
                    ->delete();
                    return redirect('/incharge/dashboard');           
    }
    public function dailyreport($logsession){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        $dataBranch = Branch::get();
        $Branches = Branch::where('id','=', $BranchId)->get();

        $dataGas = Gastype::get();
        $arrayGas = array();
        foreach($dataGas as $Gastypes){
            $dataGasPumplog = Pumplog::where('gasid', '=', $Gastypes->id)->where('logsession', "=", $logsession)->get();
            $volume =0;
            $price = 0;
            foreach($dataGasPumplog as $Pumplog){
                $volume = $volume + $Pumplog->consumevolume;
                $price = $Pumplog->unitprice;
            }
            $gassummary = array($Gastypes->gasname, $volume, $price);
            array_push($arrayGas, $gassummary);
        }
        $dataBranchcredit = Branchcredit::where('creditsession', "=", $logsession)->get();
        $dataBranchsale = Branchsale::where('salesession', "=", $logsession)->get();
        $dataBranchdiscount = Branchdiscount::where('discountsession', "=", $logsession)->get();
        $dataBranchother = Branchother::where('descsession', "=", $logsession)->get();
        $dataPumplog = Pumplog::where('logsession', "=", $logsession)->get();
        $dataDate = Pumplog::where('logsession', "=", $logsession)->first();
        //return redirect('/incharge/daily-report/'.$logsession);
        return view('incharge.printreport', compact('dataBranch', 'BranchId', 'Branches', 'dataBranchgasPump', 'dataPumpReading', 'dataPumplog', 'dataBranchcredit', 'dataBranchdiscount', 'dataBranchsale', 'dataBranchother', 'arrayGas', 'logsession', 'dataDate'));
    }
    public function viewrecord($logsession){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        $dataBranch = Branch::get();
        $Branches = Branch::where('id','=', $BranchId)->get();

        $dataGas = Gastype::get();
        $arrayGas = array();
        foreach($dataGas as $Gastypes){
            $dataGasPumplog = Pumplog::where('gasid', '=', $Gastypes->id)->where('logsession', "=", $logsession)->get();
            $volume =0;
            $price = 0;
            foreach($dataGasPumplog as $Pumplog){
                $volume = $volume + $Pumplog->consumevolume;
                $price = $Pumplog->unitprice;
            }
            $gassummary = array($Gastypes->gasname, $volume, $price);
            array_push($arrayGas, $gassummary);
        }
        $dataBranchcredit = Branchcredit::where('creditsession', "=", $logsession)->get();
        $dataBranchsale = Branchsale::where('salesession', "=", $logsession)->get();
        $dataBranchdiscount = Branchdiscount::where('discountsession', "=", $logsession)->get();
        $dataBranchother = Branchother::where('descsession', "=", $logsession)->get();
        $dataPumplog = Pumplog::where('logsession', "=", $logsession)->get();
        $dataDate = Pumplog::where('logsession', "=", $logsession)->first();
        return view('incharge.viewrecord', compact('dataBranch', 'BranchId', 'Branches', 'dataBranchgasPump', 'dataPumpReading', 'dataPumplog', 'dataBranchcredit', 'dataBranchdiscount', 'dataBranchsale', 'dataBranchother', 'arrayGas', 'logsession', 'dataDate'));
    }
    public function payments(){

        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        $Branches = Branch::where('id','=', $BranchId)->get();
        $accountBill = Accountbill::where('branchid', '=', $BranchId)->where('billstatus', '=', 'not paid')->with('account')->latest()->paginate(50);  
        return view('incharge.payments', compact('dataBranch', 'Branches', 'accountBill'));
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
        $accountBill = Accountbill::where('branchid', '=', $BranchId)->with('account')->latest()->paginate(50);  
        //dd($dataAccount);
        return view('incharge.bills', compact('dataBranch', 'Branches', 'accountBill'));

    }
    public function viewbill($billid){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        $Branches = Branch::where('id','=', $BranchId)->get();
        $accountBill = Accountbill::where('id', '=', $billid)->with('account', 'user')->take(1)->get();
        foreach($accountBill as $dataBill) {
            $daterange = explode('-', $dataBill->billdate); 
            $fromDate = trim(str_replace('/', '-', $daterange[0]));
            $toDate = trim(str_replace('/', '-', $daterange[1]));
        $dataCreditPetrol = Accountcredit::where('creditdate', '>=', $fromDate)->with('gas')
            ->where('creditdate', '<=', $toDate)->where('credittype', '=', 'Petrol')->get();
        $dataCreditProduct = Accountcredit::where('creditdate', '>=', $fromDate)->with('productdetails')
            ->where('creditdate', '<=', $toDate)->where('credittype', '=', 'Product')->get();
        }  
        $dataAccount = Account::where('id', '=', $BranchId)->get();
         
        //dd($accountBill);
        return view('incharge.bill', compact('dataCreditProduct','dataCreditPetrol','dataBranch', 'Branches', 'accountBill', 'billid', 'dataCredit'));

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
        $accountBill = Branchpayment::where('accountid', '=', $accountId)->with('bill')->latest()->get();
        //$paymentHistory = Branchpayment::where();
        //dd($dataAccount);
        return view('incharge.account', compact('dataBranch', 'Branches', 'dataAccount', 'recentBill', 'historyBill', 'accountBill'));

    }
    public function paybill($billid){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;
        $dataAccount = Account::where('branchid', '=', $BranchId)->get(); 
        $accountBill = Accountbill::where('id', '=', $billid)->with('account')->take(1)->get();
        return view('incharge.payment', compact('dataBranch', 'Branches', 'dataAccount', 'accountBill'));  
    }
    public function processpayment(Request $req){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $accountBill = Accountbill::where('id', '=', $req->paymentbillid)->with('account', 'user')->take(1)->get();
        foreach($accountBill as $dataBill) {
          $billamount = $dataBill->balance;

          $billaccountid = $dataBill->accountid;
        }  
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $dataBranch->branchid;

        $dataPayment = new Branchpayment();
        $dataPayment->userid = $userId;
        $dataPayment->branchid = $BranchId;
        $dataPayment->billid = $req->paymentbillid;
        $dataPayment->accountid = $billaccountid;
        $dataPayment->payment = $req->paymentadd;
        $billbalance = $billamount - $req->paymentadd;
        $dataPayment->balance = $billbalance;
        $dataPayment->save();
        if($req->paymentadd >= $billamount) {
            $updateAccountbill = Accountbill::where('id', '=', $req->paymentbillid)
                    ->update(['billstatus' => 'paid', 'balance' => $billbalance]);
        }
        else {
            $updateAccountbill = Accountbill::where('id', '=', $req->paymentbillid)
                    ->update(['balance' => $billbalance]);
        }
        return redirect()->back()->with('success','Payment successfully added!');
    }
    public function viewpaymenthistory($accountId){
        $this->branchaccount();
        $dataAccount = Account::where('id', '=', $accountId)->get(); 
        $accountBill = Branchpayment::where('accountid', '=', $accountId)->with('bill')->latest()->get();

        return view('incharge.paymenthistory', compact('accountBill', 'dataAccount'));
    }
}
