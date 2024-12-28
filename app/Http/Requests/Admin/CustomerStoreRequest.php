<?php

namespace App\Http\Requests\Admin;

use App\Models\Account;
use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:customers,name,NULL,id,company_code,' . auth()->user()->company_code,
            ],
            'start_balance_status' => 'required|in:متزن,دائن,مدين',
            'start_balance' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    if ($this->start_balance_status === 'متزن' && $value != 0) {
                        $fail('رصيد أول المدة يجب أن يكون 0 إذا كانت حالة الرصيد "متزن".');
                    }
                },
            ],
            'notes' => 'nullable|string',
            'address' => 'nullable|string',
            'active' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'الاسم يجب أن يكون نصًا.',
            'name.max' => 'الاسم لا يمكن أن يتجاوز 255 حرفًا.',
            'name.unique' => 'الاسم موجود بالفعل لهذه الشركة.',

           
            'start_balance_status.required' => 'حالة رصيد أول المدة مطلوبة.',
            'start_balance_status.in' => 'حالة رصيد أول المدة يجب أن تكون "متزن" أو "دائن" أو "مدين".',

            'start_balance.required' => 'رصيد أول المدة مطلوب.',
            'start_balance.numeric' => 'رصيد أول المدة يجب أن يكون رقمًا.',
            'start_balance.min' => 'رصيد أول المدة يجب أن يكون أكبر من أو يساوي 0.',

            'notes.string' => 'الملاحظات يجب أن تكون نصًا.',
            'address.string' => 'العنوان يجب أن تكون نصًا.',

            'active.required' => 'حالة التفعيل مطلوبة.',
            'active.boolean' => 'حالة التفعيل يجب أن تكون إما مفعل أو معطل.',

          
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        return array_merge($validated, [
            'added_by' => auth()->id(),
            'company_code' => auth()->user()->company_code,
            'date' => date('Y-m-d'),
            'account_number' => $this->lastAccountNumberPlusOne(),
            'customer_code' => $this->lastCustomerCodePlusOne(),
        ]);
    }

    public function lastAccountNumberPlusOne()
    {
        $account = Account::where('company_code', auth()->user()->company_code)->latest('account_number')->first();

        return $account ? $account->account_number + 1 : 1;
    }

    public function lastCustomerCodePlusOne()
    {
        $customer = Customer::where('company_code', auth()->user()->company_code)->latest('customer_code')->first();

        return $customer ? $customer->customer_code + 1 : 1;
    }
}
