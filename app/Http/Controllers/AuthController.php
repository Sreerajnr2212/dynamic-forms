<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function login_admin(){
        
        if(!empty(Auth::check()) && Auth::user()->is_admin==1){
            return redirect('admin/form/list');
        }else{
            return view('admin.login');
        }
    }
    public function auth_login_admin(Request $request){
        $remember = !empty($request->remember)?true:false;
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'is_admin'=>1],$remember)){
            return redirect('admin/form/list');
        }else{
            return redirect()->back()->with('error','Please Enter Valid Email and Password');
        }
    }
    public function admin_logout(){
        Auth::logout();
        return redirect('admin');
    }
}
