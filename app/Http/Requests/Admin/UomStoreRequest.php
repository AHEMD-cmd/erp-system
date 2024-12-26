<?php

namespace App\Http\Requests\Admin;

use App\Models\Uom;
use Illuminate\Foundation\Http\FormRequest;

class UomStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
      
        return [
            'name' => 'required|string|max:255|unique:Uoms,name,NULL,id,company_code,' . auth()->user()->company_code,
            'is_master' => ['required','boolean'],
           
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
            'name.required' => 'اسم الخزنة مطلوب.',
            'name.string' => 'اسم الخزنة يجب أن يكون نصًا.',
            'name.max' => 'اسم الخزنة يجب ألا يتجاوز 255 حرفًا.',
            'name.unique' => 'اسم الوحدة موجود بالفعل لنفس الشركة.',

            'is_master.required' => 'حقل هل رئيسية مطلوب.',
            'is_master.boolean' => 'حقل هل رئيسية يجب أن يكون صحيحًا أو خطأ.',

            'active.required' => 'حالة التفعيل مطلوبة.',
            'active.boolean' => 'حالة التفعيل يجب أن تكون مفعل أو معطل.',
        ];
    }

    /**
     * Customize the validated data before returning it.
     *
     * @param string|null $key
     * @param mixed $default
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
