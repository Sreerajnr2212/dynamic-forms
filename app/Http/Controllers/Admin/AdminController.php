<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FormModel;

class AdminController extends Controller
{
    public function index(){
        $data['header_title']="Admin Forms";
        $data['forms'] = array();
        return view('admin.form.list',$data);
    }
    public function add(){
        $data['header_title']="Admin";
        return view('admin.form.add',$data);
    }
 
}
