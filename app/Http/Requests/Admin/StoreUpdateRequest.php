<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // You can add any authorization logic here
        return true; // Allow all users for now
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Use the stores table and ensure the 'name' is unique with the same company_code 
        // except for the current record
        return [
            'name' => 'required|unique:stores,name,' . $this->route('store')->id . ',id,company_code,' . auth()->user()->company_code,
            'active' => 'required|boolean',
            'phone' => 'required|string|max:255|regex:/^[0-9]{9,15}$/',
            'address' => 'required|string|max:255',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'اسم المتجر مطلوب',
            'name.unique' => 'اسم المتجر يجب أن يكون فريدًا مع نفس الشركة',
            'active.required' => 'حالة التفعيل مطلوبة',
            'active.boolean' => 'حالة التفعيل يجب أن تكون إما مفعل أو معطل',
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
     * Get the validated data from the request, including the updated_by field.
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return array
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        // Add the updated_by field to the validated data
        $validated['updated_by'] = auth()->id();    
        return $validated;
    }
}
