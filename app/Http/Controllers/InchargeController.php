<?php

namespace App\Http\Controllers;

use App\Branch;

use Illuminate\Http\Request;

class InchargeController extends Controller
{
    //
    public function index()
    {
        $dataBranch = Branch::get();
        return view('incharge.dashboard', compact('dataBranch'));
    }

    public function dipping()
    {
        $dataBranch = Branch::get();
        return view('incharge.dipping', compact('dataBranch'));
    }
    public function accounts()
    {
        $dataBranch = Branch::get();
        return view('incharge.accounts', compact('dataBranch'));
    }
    public function pumps()
    {
        $dataBranch = Branch::get();
        return view('incharge.pumps', compact('dataBranch'));
    }
    public function report()
    {
        $dataBranch = Branch::get();
        return view('incharge.report', compact('dataBranch'));
    }
}
