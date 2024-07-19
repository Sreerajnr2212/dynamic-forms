<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormValidRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'form_name' => 'required|string|max:255',
            'label' => 'required|array',
            'label.*' => 'required|string|max:255',
            'field_name' => 'required|array',
            'field_name.*' => 'required|string|max:255',
            'field_type' => 'required|array',
            'field_type.*' => 'required|string|in:text,number,email,textarea,select,checkbox,radio,password',
            'value' => 'array', // Make value array conditional
        ];

        $fieldTypes = $this->input('field_type', []);
        
        foreach ($fieldTypes as $index => $type) {
            if (in_array($type, ['select', 'checkbox', 'radio'])) {
                $rules["value.$index"] = 'required|array';
                $rules["value.$index.*"] = 'required|string|max:255';
            } else {
                $rules["value.$index"] = 'nullable|array'; // Make value nullable
                $rules["value.$index.*"] = 'nullable|string|max:255';
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'form_name.required' => 'The form name field is required.',
            'label.required' => 'The label field is required.',
            'label.*.required' => 'The label field is required.',
            'field_name.required' => 'The field name field is required.',
            'field_name.*.required' => 'The field name is required.',
            'field_type.required' => 'The field type field is required.',
            'field_type.*.required' => 'The field type is required.',
            'field_type.*.in' => 'The selected field type is invalid.',
            'value.required' => 'The value field is required for some field types.',
            'value.*.required' => 'The value field is required.',
            'value.*.*.required' => 'The value field is required.',
        ];
    }
}
