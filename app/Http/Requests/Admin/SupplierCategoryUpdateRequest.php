<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SupplierCategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Add any specific authorization logic if needed
        return true; // Allow all users for now
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Use the supplier_categories table and ensure 'name' is unique with the same company_code
        // except for the current record
        return [
            'name' => 'required|unique:supplier_categories,name,' . $this->route('supplier_category')->id . ',id,company_code,' . auth()->user()->company_code,
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

        $validated['updated_by'] = auth()->id(); // Add the user who updated the record
        return $validated;
    }
}
