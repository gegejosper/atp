<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function userLogin(Request $request){
       
        if(Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])){
            $user = User::where('username', $request->username )->first();
        
            if($user->usertype=='admin'){
                return redirect('admin/home');
               
            }
            if($user->usertype=='assistant'){
                return redirect('assistant/home');
               
            }
            else {
                return redirect('/');
            }
        }
        else {
            //return('error');
            return redirect()->back()->with('error', 'Login Credentials Incorrect!');
        }
        //return redirect('dashboard');
    }
}
