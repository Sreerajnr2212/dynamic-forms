<?php 

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormField;
use App\Http\Requests\FormValidRequest;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendFormCreatedNotification;

class FormController extends Controller
{
    public function index(Request $request)
    {  
        $forms = Form::all();
        return view('admin.form.list', compact('forms'));
    }
    public function store(FormValidRequest $request)
    {
        
        $form = Form::create([
            'form_name' => $request->form_name,
        ]);

        foreach ($request->label as $index => $label) {
            $values = in_array($request->field_type[$index], ['select', 'checkbox', 'radio']) ? json_encode($request->value[$index] ?? []) : null;
            FormField::create([
                'form_id' => $form->id,
                'label' => $label,
                'field_name' => $request->field_name[$index],
                'field_type' => $request->field_type[$index],
                'options' => $values,
            ]);
        }
        SendFormCreatedNotification::dispatch($form);
        return redirect()->route('form.list')->with('success', 'Form saved successfully.');
    }
    public function edit(string $id)
    {
        $data['geForm']=Form::with('fields')->findOrFail($id);
        $data['header_title']="Edit Form";
        $data['form'] = Form::with('fields')->findOrFail($id);
        return view('admin.form.edit',$data);

    }
    public function update(FormValidRequest $request, String $id){
       
        $form = Form::findOrFail($id);

        $form->form_name = $request->input('form_name');
        $form->save();

        $form->fields()->delete();

        foreach ($request->label as $index => $label) {
            $values = in_array($request->field_type[$index], ['select', 'checkbox', 'radio']) ? json_encode($request->value[$index] ?? []) : null;
            $formField = new FormField([
                'label' => $label,
                'field_name' => $request->field_name[$index],
                'field_type' => $request->field_type[$index],
                'options' => $values,
            ]);
            $form->fields()->save($formField);
        }
        return redirect()->route('form.list')->with('success', 'Form updated successfully');

    }
    public function delete(String $id)
    {
        $form = Form::findOrFail($id);
        $form->delete();
        return redirect()->back()->with('success', 'Form deleted successfully.');
    }
}
