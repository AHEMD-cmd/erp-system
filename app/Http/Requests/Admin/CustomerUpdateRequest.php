<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:customers,name,' . $this->route('customer') . ',id,company_code,' . auth()->user()->company_code,
            ],
           
            'notes' => 'nullable|string',
            'address' => 'nullable|string',
            'active' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'الاسم يجب أن يكون نصًا.',
            'name.max' => 'الاسم لا يمكن أن يتجاوز 255 حرفًا.',
            'name.unique' => 'الاسم موجود بالفعل لهذه الشركة.',

          
            'notes.string' => 'الملاحظات يجب أن تكون نصًا.',

            'address.string' => 'العنوان يجب أن تكون نصًا.',

            'active.required' => 'حالة التفعيل مطلوبة.',
            'active.boolean' => 'حالة التفعيل يجب أن تكون إما مفعل أو معطل.',

          
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        return array_merge($validated, [
            'updated_by' => auth()->id(),
          
        ]);
    }
}
