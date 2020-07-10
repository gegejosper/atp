<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Purchaserecord;
use App\Branch;
use App\Branchgases;
use App\Gastype;
use App\Orderrecord;
use Illuminate\Support\Facades\Auth;


class PurchaseController extends Controller
{
    //
    public function createpurchase(Request $request)
    {
       
            $data = new Purchase();
            $data->purchasenumber = $request->purchasenumber;
            $data->date = $request->purchasedate;
            $data->branch_id = $request->branch;
            $data->status = 'initial';
            $data->save();
            return redirect('admin/order/createpurchase/'.$request->purchasenumber.'/'.$request->branch);
            //return response()->json($data);
    }

    public function createpurchaserequest($purnumber, $branchid)
    {
        
        $dataBranch = Branch::get();
        $purchasenumber = $purnumber;
        $BranchId = $branchid;
        $dataPurchaseRecord = Purchaserecord::where('purchasenumber','=',$purchasenumber)
                                ->with('gasdetail')
                                ->get();
        $Gas= Branchgases::where('branchid', '=', $BranchId)->with('gas')->get();

        return view('admin.createpurchase',compact('purchasenumber', 'dataPurchaseRecord', 'dataBranch', 'Gas')); 
    }
    public function addquantityrequest(Request $request)
    {
        $data = new Purchaserecord();
        $data->purchasenumber = $request->purchasenumber;
        $data->date = $request->date;
        $data->quantity = $request->quantity;
        $data->itemid = $request->itemid;
        $data->status = 'initial';
        $data->save();
        return response()->json();
    }
    public function generatepurchaseorder(Request $request)
    {
        //$data = new Purchaserecord();
        $updatePurchaseRecord = Purchaserecord::where('purchasenumber', '=', $request->purchasenumber)
                ->update(['status' => 'ordered']);
        $updatePurchase = Purchase::where('purchasenumber', '=', $request->purchasenumber)
        ->update(['status' => 'ordered']);
        //$data->save();
        return response()->json();
    }
    public function purchaseorderhistory($purchasenumber)
    {
        // $dataProductquantity = Product::with('quantity')
        // ->get();
        // //dd($dataProductquantity);
        // $data = Branch::with('cashier')->get();
        if (Auth::check())
        {
            $userId = Auth::user()->id;
            $name = Auth::user()->name;
        }
        
        $dataBranch = Branch::get();
        $dataPurchase = Purchaserecord::groupby('purchasenumber')->orderby('date', 'DESC')->latest()->take(10)->get();
        $dataPurchaseDetail = Purchaserecord::where('purchasenumber', '=', $purchasenumber)->first();
        $dataPurchaseRecord = Purchaserecord::where('purchasenumber','=',$purchasenumber)->with('gasdetail')->get();
        $dataRecord = Orderrecord::where('prnum','=',$purchasenumber)->take(1)->get();
        // $dataUser = User::where('usertype', '=', 'cashier')->get();
        //dd($dataRecord);
        return view('admin.purchasehistory',compact('dataPurchaseRecord', 'dataPurchase', 'purchasenumber', 'dataBranch', 'dataPurchaseDetail', 'dataRecord', 'name'));
      
    }

    public function purchaseorderhistoryIncharge($purchasenumber)
    {
        $dataBranch = Branch::get();
        $dataPurchase = Purchaserecord::where('purchasenumber', '=', $purchasenumber)->first();
        //dd($dataPurchase);
        $dataPurchaseRecord = Purchaserecord::where('purchasenumber','=',$purchasenumber)->with('gasdetail')->get();
        return view('incharge.purchasehistory',compact('dataPurchaseRecord', 'dataPurchase', 'purchasenumber', 'dataBranch'));
    }

    public function addquantityrecieve (Request $req){
        $data = array('id'=>$req->purreqid,'recievequantity' =>$req->recievequantity , 'recquantity' => $req->recquantity, 'gasname'=>$req->gasname, 'price' => $req->unitprice);
        //dd($data)
        $updatePurchase = Purchaserecord::where('id', '=', $req->purreqid)
        ->update(['recquantity' => $req->recievequantity, 'price' => $req->unitprice]);
        
        return response()->json($data);
    }

    public function addquantityrecieveIncharge (Request $req){
        $data = array('id'=>$req->purreqid, 'recquantity' => $req->recievequantity, 'gasname' => $req->gasname, 'reqquantity' => $req->recquantity, 'price' => $req->unitprice);
        $updatePurchase = Purchaserecord::where('id', '=', $req->purreqid)
        ->update(['recquantity' => $req->recievequantity]);
        //dd ($data);
        return response()->json($data);
    }
    public function addunitprice (Request $req){
        $data = array('id'=>$req->purreqid, 'recievequantity' => $req->recievequantity, 
            'gasname' => $req->gasname, 
            'reqquantity' => $req->recquantity, 
            'price' => $req->unitprice);
        $updatePurchase = Purchaserecord::where('id', '=', $req->purreqid)
        ->update(['price' => $req->unitprice]);
        //dd ($data);
        return response()->json($data);
    }
    public function receivePurchase($purchasenumber){
        $dataPurchase = Purchase::where('purchasenumber', '=', $purchasenumber)->first();
        $dataPurchaserecord = Purchaserecord::where('purchasenumber', '=', $purchasenumber)->get();
        //dd($dataPurchaserecord);
        $branch_id = $dataPurchase->branch_id;
        foreach($dataPurchaserecord as $Purchaserecord){
            $gas_id = $Purchaserecord->itemid;
            $gas_volume_recieve = $Purchaserecord->recquantity;
            $data_branch_gases = Branchgases::where('branchid', '=', $branch_id)->where('gasid', '=', $gas_id)->first();    
            $gas_volume = $data_branch_gases->volume;
            $new_gas_volume = $gas_volume + $gas_volume_recieve;
            $updateBranchgases = Branchgases::where('id', '=', $data_branch_gases->id)
            ->update(['volume' => $new_gas_volume]); 
        }
        $updatePurchase = Purchase::where('purchasenumber', '=', $purchasenumber)
        ->update(['status' => 'received']); 
        
        $updatePurchase = Purchaserecord::where('purchasenumber', '=', $purchasenumber)
        ->update(['status' => 'received']);

        return redirect('/incharge/order');
    }
    public function savepurchaserec(Request $req){
        if (Auth::check())
        {
            $userId = Auth::user()->id;
        }
        $dataPurRec = new Orderrecord();
        $dataPurRec->prnum = $req->prnum;
        $dataPurRec->checkdate = $req->checkdate;
        $dataPurRec->bankname = ucwords($req->bankname);
        $dataPurRec->checknum = $req->checknum;
        $dataPurRec->amount = $req->amount;
        $dataPurRec->userid = $userId;
        $dataPurRec->status = 'Processed';
        $dataPurRec->save();
        return redirect()->back()->with('success','Purchase record successfully save!');
    }
}
