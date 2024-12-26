<?php

namespace App\Http\Requests\Admin;

use App\Models\Treasury;
use Illuminate\Foundation\Http\FormRequest;

class TreasuryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Update based on your authorization logic if needed
    }

    

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $validParentIds = Treasury::where([
            'company_code' => auth()->user()->company_code,
            'is_master' => 1
        ])->pluck('id')->toArray();
        
        $id = $this->route('treasury')->id; // Get the ID of the treasury being updated

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Ensure unique name with the same company_code but exclude the current treasury
                'unique:treasuries,name,' . $id . ',id,company_code,' . auth()->user()->company_code,
            ],
            'is_master' => [
                'required',
                'boolean',
                // Ensure only one master treasury per company_code
                function ($attribute, $value, $fail) use($id) {
                    if ($value && \App\Models\Treasury::where('is_master', 1)
                        ->where('company_code', auth()->user()->company_code)
                        ->where('id', '!=', $id)
                        ->exists()) {
                        $fail('لا يمكن أن يكون هناك أكثر من خزنة رئيسية للشركة.');
                    }
                },
            ],
            'last_isal_exchange' => 'required|numeric|min:0',
            'last_isal_collect' => 'required|numeric|min:0',
            'active' => 'required|boolean',

            'parent_id' => [
                'nullable',
                'integer',
                'in:' . implode(',', $validParentIds),
            ],
        ];
    }

    /**
     * Get the custom validation messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'اسم الخزنة مطلوب.',
            'name.string' => 'اسم الخزنة يجب أن يكون نصاً.',
            'name.max' => 'اسم الخزنة يجب ألا يتجاوز 255 حرفًا.',
            'name.unique' => 'اسم الخزنة موجود مسبقاً للشركة.',
            'is_master.required' => 'حقل هل رئيسية مطلوب.',
            'is_master.boolean' => 'قيمة حقل هل رئيسية غير صحيحة.',
            'last_isal_exchange.required' => 'حقل آخر إيصال صرف مطلوب.',
            'last_isal_exchange.numeric' => 'حقل آخر إيصال صرف يجب أن يكون رقماً.',
            'last_isal_exchange.min' => 'حقل آخر إيصال صرف يجب ألا يكون أقل من صفر.',
            'last_isal_collect.required' => 'حقل آخر إيصال تحصيل مطلوب.',
            'last_isal_collect.numeric' => 'حقل آخر إيصال تحصيل يجب أن يكون رقماً.',
            'last_isal_collect.min' => 'حقل آخر إيصال تحصيل يجب ألا يكون أقل من صفر.',
            'active.required' => 'حالة التفعيل مطلوبة.',
            'active.boolean' => 'قيمة حقل حالة التفعيل غير صحيحة.',

            'parent_id.integer' => 'معرف الخزنة الرئيسية يجب أن يكون رقمًا صحيحًا.',
            'parent_id.in' => 'الخزنة الرئيسية المحددة غير صالحة.',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        $validated['updated_by'] = auth()->id();    
        return $validated;
    }
}
