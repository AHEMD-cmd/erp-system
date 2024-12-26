<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Treasury;

class TreasuryStoreRequest extends FormRequest
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
        // Get valid parent treasury IDs
        $validParentIds = Treasury::where([
            'company_code' => auth()->user()->company_code,
            'is_master' => 1
        ])->pluck('id')->toArray();

        return [
            'name' => 'required|string|max:255|unique:treasuries,name,NULL,id,company_code,' . auth()->user()->company_code,
            'is_master' => [
                'required',
                'boolean',
                function ($attribute, $value, $fail) {
                    if ($value == 1 && Treasury::where('is_master', 1)->where('company_code', auth()->user()->company_code)->exists()) {
                        $fail('لا يمكن أن تكون هناك أكثر من خزنة رئيسية واحدة لكل شركة.');
                    }
                },
            ],
            'last_isal_exchange' => 'required|integer|min:0',
            'last_isal_collect' => 'required|integer|min:0',
            'active' => 'required|boolean',
            'parent_id' => [
                'nullable',
                'integer',
                'in:' . implode(',', $validParentIds),
            ],
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
            'name.unique' => 'اسم الخزنة موجود بالفعل لنفس الشركة.',

            'is_master.required' => 'حقل هل رئيسية مطلوب.',
            'is_master.boolean' => 'حقل هل رئيسية يجب أن يكون صحيحًا أو خطأ.',

            'last_isal_exchange.required' => 'آخر إيصال صرف مطلوب.',
            'last_isal_exchange.integer' => 'آخر إيصال صرف يجب أن يكون رقمًا صحيحًا.',
            'last_isal_exchange.min' => 'آخر إيصال صرف يجب أن يكون رقمًا غير سالب.',

            'last_isal_collect.required' => 'آخر إيصال تحصيل مطلوب.',
            'last_isal_collect.integer' => 'آخر إيصال تحصيل يجب أن يكون رقمًا صحيحًا.',
            'last_isal_collect.min' => 'آخر إيصال تحصيل يجب أن يكون رقمًا غير سالب.',

            'active.required' => 'حالة التفعيل مطلوبة.',
            'active.boolean' => 'حالة التفعيل يجب أن تكون مفعل أو معطل.',

            'parent_id.integer' => 'معرف الخزنة الرئيسية يجب أن يكون رقمًا صحيحًا.',
            'parent_id.in' => 'الخزنة الرئيسية المحددة غير صالحة.',
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
