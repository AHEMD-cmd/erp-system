<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ItemCardCategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Allow all users for now. Update this logic as needed.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Use the item_card_categories table and ensure the 'name' is unique for the same company_code
        // except for the current record
        return [
            'name' => 'required|unique:item_card_categories,name,' . $this->route('item_card_category')->id . ',id,company_code,' . auth()->user()->company_code,
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
     * Customize the validated data.
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return array
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        $validated['updated_by'] = auth()->id();
        return $validated;
    }
}
