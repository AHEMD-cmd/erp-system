<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SalesMaterialTypeUpdateRequest extends FormRequest
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

        // Use the sales_material_types table and ensure the 'name' is unique with the same company_code 
        // except for the current record
        return [
            'name' => 'required|unique:sales_material_types,name,' . $this->route('sales_material_type')->id . ',id,company_code,' . auth()->user()->company_code,
            'active' => 'required|boolean',
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
            'name.required' => 'اسم الفئة مطلوب',
            'name.unique' => 'اسم الفئة يجب أن يكون فريدًا مع نفس الشركة',
            'active.required' => 'حالة التفعيل مطلوبة',
            'active.boolean' => 'حالة التفعيل يجب أن تكون إما مفعل أو معطل',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        $validated['updated_by'] = auth()->id();    
        return $validated;
    }
}
