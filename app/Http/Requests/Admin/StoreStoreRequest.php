<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Adjust this based on your authorization logic
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
                // Unique validation with the condition of the company_code of the authenticated user
                'unique:stores,name,NULL,id,company_code,' . Auth::user()->company_code
            ],
            'active' => 'required|boolean',
            'phone' => 'required|string|max:255|regex:/^[0-9]{9,15}$/',
            'address' => 'required|string|max:255',
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
            'name.required' => 'اسم المتجر مطلوب',
            'name.string' => 'اسم المتجر يجب أن يكون نص',
            'name.max' => 'اسم المتجر يجب ألا يتجاوز 255 حرفًا',
            'name.unique' => 'اسم المتجر موجود بالفعل لهذه الشركة',
            'active.required' => 'حالة التفعيل مطلوبة',
            'active.boolean' => 'حالة التفعيل يجب أن تكون مفعل أو معطل.',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.string' => 'رقم الهاتف يجب أن يكون نص',
            'phone.max' => 'رقم الهاتف يجب ألا يتجاوز 255 حرفًا',
            'phone.regex' => 'رقم الهاتف غير صالح. يجب أن يحتوي على 9 إلى 15 رقماً .',
            'address.required' => 'العنوان مطلوب',
            'address.string' => 'العنوان يجب أن يكون نص',
            'address.max' => 'العنوان يجب ألا يتجاوز 255 حرفًا',

        ];
    }

    /**
     * Get the validated data from the request, including custom fields like `added_by`, `company_code`, and `date`.
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
