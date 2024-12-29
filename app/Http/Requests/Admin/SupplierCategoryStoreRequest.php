<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class SupplierCategoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Adjust this as needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:supplier_categories,name,NULL,id,company_code,' . Auth::user()->company_code,
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
            'name.string' => 'اسم الفئة يجب أن يكون نصًا',
            'name.max' => 'اسم الفئة يجب ألا يتجاوز 255 حرفًا',
            'name.unique' => 'اسم الفئة موجود بالفعل لهذه الشركة',
            'active.required' => 'حالة التفعيل مطلوبة',
            'active.boolean' => 'حالة التفعيل يجب أن تكون مفعل أو معطل.',
        ];
    }

    /**
     * Get the validated data from the request.
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return array
     */
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
