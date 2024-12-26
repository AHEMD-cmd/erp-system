<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class SalesMaterialTypeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Unique validation with the condition of the company_code of the authenticated user
                'unique:sales_material_types,name,NULL,id,company_code,' . Auth::user()->company_code
            ],
            'active' => 'required|boolean',
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'اسم الفئة مطلوب',
            'name.string' => 'اسم الفئة يجب أن يكون نص',
            'name.max' => 'اسم الفئة يجب ألا يتجاوز 255 حرفًا',
            'name.unique' => 'اسم الفئة موجود بالفعل لهذه الشركة',
            'active.required' => 'حالة التفعيل مطلوبة',
            'active.boolean' => 'حالة التفعيل يجب أن تكون مفعل أو معطل.',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        return array_merge($validated, [
            'added_by' => auth()->id(),
            'company_code' => auth()->user()->company_code,
            'date' => date('Y-m-d'),
        ]);
    }
}
