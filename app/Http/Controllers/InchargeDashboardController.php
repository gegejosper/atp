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
use App\Branchdiscount;
use App\Branchother;
use App\Branchsale;
use App\Account;
use App\Pumprecord;

use Illuminate\Support\Facades\Auth;

class InchargeDashboardController extends Controller
{
    //
    public function creditadd(Request $req){
        $data = new Branchcredit();
        $data->invoice  = $req->invoice;
        $data->account  = $req->account;
        $data->gasname  = $req->gasname;
        $data->liters  = $req->creditliters;
        $data->branchid  = $req->branchid;
        $data->creditplatenum  = $req->creditplatenum;
        $data->amount  = $req->creditamount;
        $data->creditdate  = $req->creditdate;
        $data->creditsession  = session()->get('sessionid');
        $data->creditstatus  = 'INITIAL';
        $data->userid = Auth::user()->id;
        $data->save();
    
        return response()->json($data);
    }

    public function creditdelete(Request $req)
    {
        Branchcredit::find($req->id)->delete();
        return response()->json();
    }

    public function discountadd(Request $req){
        $data = new Branchdiscount();
        $data->branchid  = $req->branchid;
        $data->userid = Auth::user()->id;
        $data->account  = $req->account;
        $data->gasname  = $req->gasname;
        $data->amount  = $req->disamount;
        $data->platenum  = $req->displatenum;
        $data->discountdate  = $req->disdate;
        $data->discountsession  = session()->get('sessionid');
        $data->status  = 'INITIAL';
        
        $data->save();
    
        return response()->json($data);
    }
    public function discountdelete(Request $req)
    {
        Branchdiscount::find($req->id)->delete();
        return response()->json();
    }

    public function salesadd(Request $req){
        if($req->paymenttype == 'CASH'){
            $account = "CASH, CASH, 0";
        }
        else {
            $account = $req->account;
        }
        
        $data = new Branchsale();
        $data->branchid  = $req->branchid;
        $data->userid = Auth::user()->id;
        $data->invoice  = $req->invoice;
        $data->account  = $account;
        $data->product  = $req->salebranchproduct;
        $data->quantity  = $req->salequantity;
        $data->paymenttype  = $req->paymenttype;
        $data->price  = $req->saleprice;
        $data->amount  = $req->saleamount;
        $data->saledate  = $req->salesdate;
        $data->salesession  = session()->get('sessionid');
        $data->status  = 'INITIAL';
        
        $data->save();
    
        return response()->json($data);
    }

    public function salesdelete(Request $req)
    {
        Branchsale::find($req->id)->delete();
        return response()->json();
    }

    public function othersadd(Request $req){
        $data = new Branchother();
        $data->branchid  = $req->branchid;
        $data->userid = Auth::user()->id;
        $data->desc  = $req->desc;
        $data->amount  = $req->amount;
        $data->othersdate  = $req->othersdate;
        $data->descsession  = session()->get('sessionid');
        $data->status  = 'INITIAL';
        
        $data->save();
    
        return response()->json($data);
    }

    public function othersdelete(Request $req)
    {
        Branchother::find($req->id)->delete();
        return response()->json();
    }
}
