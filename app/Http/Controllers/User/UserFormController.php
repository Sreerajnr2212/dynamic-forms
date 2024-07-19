<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\Form;
use App\Models\FormData;

use Illuminate\Http\Request;

class UserFormController extends Controller
{
    public function index()
    {
        $data['forms'] = Form::all();
        return view('user.form_lists', $data);
    }
    public function show($id)
    {
        $data['form'] = Form::findOrFail($id);
        return view('user.add', $data);
    }
    public function store(Request $request)
    {
        
        $formId = $request->input('form_id');
        $formData = $request->except(['_token', 'form_id']);
        

        FormData::create([
            'form_id' => $formId,
            'form_data' => json_encode($formData),
        ]);

        return redirect()->back()->with('success', 'Form data saved successfully.');
    }
}
