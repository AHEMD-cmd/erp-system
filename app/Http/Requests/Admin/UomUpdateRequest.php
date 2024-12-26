<?php

namespace App\Http\Requests\Admin;

use App\Models\Uom;
use Illuminate\Foundation\Http\FormRequest;

class UomUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Assuming you have some authorization logic; modify accordingly
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Assuming that the current Uom record is passed into the request and accessible via $this->route('uom')
        $uomId = $this->route('uom')->id;

        return [
            'name' => 'required|string|max:255|unique:Uoms,name,' . $uomId . ',id,company_code,' . auth()->user()->company_code,
            'is_master' => 'required|boolean',
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
            'name.required' => 'اسم الوحدة مطلوب.',
            'name.string' => 'اسم الوحدة يجب أن يكون نصًا.',
            'name.max' => 'اسم الوحدة يجب ألا يتجاوز 255 حرفًا.',
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

        // For updating, you typically don't modify 'added_by', 'company_code', and 'date' unless needed
        return array_merge($validated, [
            'updated_by' => auth()->id(), // Track the user who made the update
            // You can exclude 'company_code' and 'date' as they shouldn't change during update.
        ]);
    }
}
