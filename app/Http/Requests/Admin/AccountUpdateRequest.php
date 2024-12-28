<?php

namespace App\Http\Requests\Admin;

use App\Models\Account;
use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:accounts,name,' . $this->route('account') . ',id,company_code,' . auth()->user()->company_code,
            ],
            'account_type_id' => 'required|exists:account_types,id',
            'notes' => 'nullable|string',
            'active' => 'required|boolean',
            'is_parent' => 'required|boolean',
            'parent_account_number' => 'nullable|required_if:is_parent,0|exists:accounts,account_number',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'الاسم يجب أن يكون نصًا.',
            'name.max' => 'الاسم لا يمكن أن يتجاوز 255 حرفًا.',
            'name.unique' => 'الاسم موجود بالفعل لهذه الشركة.',

            'account_type_id.required' => 'نوع الحساب مطلوب.',
            'account_type_id.exists' => 'نوع الحساب المحدد غير موجود.',

            'notes.string' => 'الملاحظات يجب أن تكون نصًا.',

            'active.required' => 'حالة التفعيل مطلوبة.',
            'active.boolean' => 'حالة التفعيل يجب أن تكون إما مفعل أو معطل.',

            'is_parent.required' => 'حقل "هل الحساب أب" مطلوب.',
            'is_parent.boolean' => 'حقل "هل الحساب أب" يجب أن يكون إما نعم أو لا.',

            'parent_account_number.required_if' => 'حقل "الحساب الأب" مطلوب إذا لم يكن الحساب أب.',
            'parent_account_number.exists' => 'الحساب الأب المحدد غير موجود.',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        return array_merge($validated, [
            'updated_by' => auth()->id(),
        ]);
    }
}
