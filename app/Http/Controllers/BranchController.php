<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Branchuser;
use App\User;
use App\Pump;
use App\Pumplog;
use App\Gaslog;
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
use App\Branchsale;
use App\Branchdiscount;
use App\Branchother;
use App\Branchreport;
use App\Branchpayment;
use App\Accountbill;
use App\Accountcredit;
use App\Branchcredit;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $branchUsers = Branchuser::where('branchid','=', $BranchId)->get();
        $dataCashier = Cashier::where('branchid', '=', $branchId)->with('user')->get();
        return view('admin.branch-user', compact('dataBranch', 'dataCashier', 'BranchId', 'Branches', 'branchUsers'));
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

    public function branchsales($branch_id)
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
        $BranchId = $branch_id;
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
        return view('admin.branch-sales', compact('dataBranch', 'dataBranchgas', 'BranchId', 'Branches', 'dataBranchgasPump', 'dataPumpReading', 'dataPump','dataAccount', 'dataProduct', 'dataGas', 'dataBranchcredit', 'dataBranchdiscount', 'dataBranchsale', 'dataBranchother'));
    }

    public function salessubmitreport (Request $req) {
        
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        //$dataBranch = Branchuser::where('userid', '=', $userId)->first();
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
            $dataGaslog = new Gaslog();
            $dataGaslog->record_number = $data->logsession;
            $dataGaslog->branch_id = $req->branchid;
            $dataGaslog->gas_id = $req->gasid[$i];
            $dataGaslog->volume = $req->consumevolume[$i];
            $dataGaslog->log_type = 'Pump Log';
            $dataGaslog->status = 'Final';
            $dataGaslog->save();  
            
            $gas_volume_consume = $req->consumevolume[$i];
            $data_branch_gases = Branchgases::where('branchid', '=', $req->branchid)->where('gasid', '=', $req->gasid[$i])->first();    
            $gas_volume = $data_branch_gases->volume;
            $new_gas_volume = $gas_volume - $gas_volume_consume;
            $updateBranchgases = Branchgases::where('id', '=', $data_branch_gases->id)
            ->update(['volume' => $new_gas_volume]); 
        } 
        $dataPumprecord = new Pumprecord();
        $dataPumprecord->branchid = $req->branchid;
        $dataPumprecord->batchcode = session()->get('batchcode'); 
        $dataPumprecord->readingdate =  date('m-d-Y');
        $dataPumprecord->save();
        session()->forget('batchcode');

        
        return redirect('/admin/dashboard/submit-report/check/'.$req->branchid);
        
    }

    public function salescheckreport($branch_id){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $branch_id;
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
        return view('admin.branch-view-sale', compact('dataBranch', 'BranchId', 'Branches', 'dataPumplog', 'dataBranchcredit', 'dataBranchdiscount', 'dataBranchsale', 'dataBranchother', 'logsession', 'arrayGas'));
        //return view('incharge.checksubmit', compact('dataBranch'));   
    }

    public function branchreportsave($logsession, $branch_id){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $branch_id;
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
        return redirect('/admin/daily-report/'.$logsession.'/'.$BranchId);
        //return view('incharge.printreport', compact('dataBranch', 'BranchId', 'Branches', 'dataBranchgasPump', 'dataPumpReading', 'dataPumplog', 'dataBranchcredit', 'dataBranchdiscount', 'dataBranchsale', 'dataBranchother'));
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
        return view('admin.branch-view-sale-record', compact('dataBranch', 'BranchId', 'Branches', 'dataBranchgasPump', 'dataPumpReading', 'dataPumplog', 'dataBranchcredit', 'dataBranchdiscount', 'dataBranchsale', 'dataBranchother', 'arrayGas', 'logsession', 'dataDate'));
    }
    public function dailyreport($logsession, $branch_id){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataBranch = Branchuser::where('userid', '=', $userId)->first();
        $BranchId = $branch_id;
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
        return view('admin.branch-print-report', compact('dataBranch', 'BranchId', 'Branches', 'dataBranchgasPump', 'dataPumpReading', 'dataPumplog', 'dataBranchcredit', 'dataBranchdiscount', 'dataBranchsale', 'dataBranchother', 'arrayGas', 'logsession', 'dataDate'));
    }
}
