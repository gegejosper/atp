<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Product;
use App\Branchproduct;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    //
    public function addProduct(Request $request)
    {
        $rules = array(
                'productname' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $data = new Product();
            $data->productname = strtoupper($request->productname);
            $data->save();

            return response()->json($data);
        }
    }
    public function editProduct(Request $req)
    {
        $data = Product::find($req->id);
        $data->productname = strtoupper($req->productname); 
        $data->save();
        return response()->json($data);
    }
    public function deleteProduct(Request $req)
    {
        Product::find($req->id)->delete();
        return response()->json();
    }
    public function addBranchProduct(Request $req){
        $data = new Branchproduct();
        $data->branchid = $req->branchid;
        $data->productid = $req->productid;
        $data->save();
        return response()->json($data); 
    }

    public function editBranchProduct(Request $req)
    {
        $data = Branchproduct::find($req->id);
        $data->price = $req->price; 
        $data->quantity = $req->quantity; 
        $data->save();
        return response()->json($data);
    }
}
