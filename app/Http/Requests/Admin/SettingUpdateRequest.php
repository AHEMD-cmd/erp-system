<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'system_name'    => 'required|string|max:255',
            'photo'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB max size
            // 'active'         => 'required|boolean',
            'general_alert'  => 'nullable|string|max:500',
            'address'        => 'nullable|string|max:255',
            'phone'          => 'nullable|regex:/^[0-9]{9,15}$/',
            'customer_parent_account_number' => 'nullable|exists:accounts,account_number',

        ];
    }

    public function messages(): array
    {
        return [
            'system_name.required'    => 'اسم النظام مطلوب.',
            'system_name.string'      => 'اسم النظام يجب أن يكون نصاً.',
            'system_name.max'         => 'اسم النظام يجب ألا يزيد عن 255 حرفاً.',
            
            'photo.image'             => 'الصورة يجب أن تكون ملف صورة صالح.',
            'photo.mimes'             => 'الصورة يجب أن تكون بامتداد: jpeg, png, jpg, gif, svg.',
            'photo.max'               => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
                        
            'general_alert.string'    => 'التنبيه العام يجب أن يكون نصاً.',
            'general_alert.max'       => 'التنبيه العام يجب ألا يزيد عن 500 حرف.',
            
            'address.string'          => 'العنوان يجب أن يكون نصاً.',
            'address.max'             => 'العنوان يجب ألا يزيد عن 255 حرفاً.',
            
            'phone.regex' => 'رقم الهاتف غير صالح. يجب أن يحتوي على 9 إلى 15 رقماً .',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'updated_by' => auth()->id(), // Set the updated_by field to the current user's ID
        ]);
    }
}
