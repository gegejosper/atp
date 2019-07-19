<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Product;
use App\Gastype;
use App\Purchase;

class AdminController extends Controller
{
    //
    public function index()
    {
        $dataBranch = Branch::get();
        return view('admin.dashboard', compact('dataBranch'));
    }
    public function sales()
    {
        $dataBranch = Branch::get();
        return view('admin.sales', compact('dataBranch'));
    }
    public function products()
    {
        $dataBranch = Branch::get();
        $dataProduct = Product::get();
        return view('admin.products', compact('dataBranch', 'dataProduct'));
    }
    public function reports()
    {
        $dataBranch = Branch::get();
        return view('admin.reports', compact('dataBranch'));
    }
    public function gastypes()
    {
        $dataBranch = Branch::get();
        $dataGastype = Gastype::get();
        return view('admin.gastypes', compact('dataGastype', 'dataBranch'));
    }
    public function petrol()
    {   
        $dataBranch = Branch::with('branchgas.gas')->get();
        //dd($dataBranch);
        return view('admin.petrol', compact('dataBranch'));
    }

    public function order()
    {   
        $dataPurchase = Purchase::take(1)->latest()->get();
        $dataBranch = Branch::with('branchgas.gas')->get();
        //dd($dataBranch);
        
        return view('admin.order', compact('dataPurchase', 'dataBranch'));
    }

    public function pumps()
    {   
        $dataBranch = Branch::get();
        return view('admin.pumps', compact('dataBranch'));
    }
    public function branches()
    {   
        
        $dataBranch = Branch::get();
        return view('admin.branches', compact('dataBranch'));
    }
    public function users()
    {
        $dataBranch = Branch::get();
        return view('admin.users', compact('dataBranch'));
    }
    public function settings()
    {
        $dataBranch = Branch::get();
        return view('admin.settings', compact('dataBranch'));
    }
}
