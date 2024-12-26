<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ItemCardUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Ensure the user is authorized to make this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('item_card')->id; // Assuming 'item_card' is the route parameter holding the ID

        return [
            // Independent fields
            'name' => 'required|unique:item_cards,name,' . $id . ',id,company_code,' . auth()->user()->company_code,
            'item_type' => 'required|in:مخزني,استهلاكي,عهدة',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'item_card_category_id' => 'required|exists:item_card_categories,id',
            'parent_id' => 'nullable|exists:item_cards,id',
            'item_code' => 'required|unique:item_cards,item_code,' . $id . ',id,company_code,' . auth()->user()->company_code,
            'barcode' => 'nullable|unique:item_cards,barcode,' . $id . ',id,company_code,' . auth()->user()->company_code,
            'has_fixed_price' => 'required|boolean',
            'uom_id' => 'required|exists:uoms,id',

            // Dependent fields
            'cost_price' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'nos_gomla_price' => 'required|numeric|min:0',
            'gomla_price' => 'required|numeric|min:0',
            'does_has_retail_unit' => 'nullable|boolean',

            // Dependent fields when 'does_has_retail_unit' is true
            'retail_uom_id' => 'required_if:does_has_retail_unit,1|exists:uoms,id',
            'retail_uom_qty_to_parent' => 'required_if:does_has_retail_unit,1|numeric|min:1',
            'cost_price_retail' => 'required_if:does_has_retail_unit,1|numeric|min:0',
            'price_retail' => 'required_if:does_has_retail_unit,1|numeric|min:0',
            'nos_gomla_price_retail' => 'required_if:does_has_retail_unit,1|numeric|min:0',
            'gomla_price_retail' => 'required_if:does_has_retail_unit,1|numeric|min:0',
        
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // Independent fields
            'name.required' => 'اسم العنصر مطلوب.',
            'name.unique' => 'اسم العنصر يجب أن يكون فريدًا مع رمز الشركة.',
            'item_type.required' => 'نوع العنصر مطلوب.',
            'item_type.in' => 'نوع العنصر يجب أن يكون إما مخزني، استهلاكي، أو عهدة.',
            'photo.image' => 'الصورة يجب أن تكون من نوع صورة.',
            'photo.mimes' => 'الصورة يجب أن تكون بإحدى الصيغ التالية: jpeg, png, jpg, gif, svg.',
            'photo.max' => 'الصورة يجب أن لا تتجاوز حجم 2 ميجابايت.',
            'item_card_category_id.required' => 'الفئة المطلوبة يجب أن تكون موجودة.',
            'item_card_category_id.exists' => 'الفئة المطلوبة غير موجودة.',
            'parent_id.exists' => 'العنصر الأب غير موجود.',
            'item_code.required' => 'رمز العنصر مطلوب.',
            'item_code.unique' => 'رمز العنصر يجب أن يكون فريدًا مع رمز الشركة.',
            'barcode.unique' => 'الباركود يجب أن يكون فريدًا مع رمز الشركة.',
            'has_fixed_price.required' => 'يجب تحديد ما إذا كان هناك سعر ثابت.',
            'has_fixed_price.boolean' => 'يجب أن يكون السعر الثابت صحيح أو خاطئ.',
            'uom_id.required' => 'وحدة القياس مطلوبة.',
            'uom_id.exists' => 'وحدة القياس المحددة غير موجودة.',

            // Dependent fields
            'cost_price.required' => 'سعر التكلفة مطلوب.',
            'cost_price.numeric' => 'سعر التكلفة يجب أن يكون رقمًا.',
            'cost_price.min' => 'سعر التكلفة يجب أن يكون أكبر من أو يساوي 0.',
            'price.required' => 'السعر مطلوب.',
            'price.numeric' => 'السعر يجب أن يكون رقمًا.',
            'price.min' => 'السعر يجب أن يكون أكبر من أو يساوي 0.',
            'nos_gomla_price.required' => 'سعر الجملة المطلوب.',
            'nos_gomla_price.numeric' => 'سعر الجملة يجب أن يكون رقمًا.',
            'nos_gomla_price.min' => 'سعر الجملة يجب أن يكون أكبر من أو يساوي 0.',
            'gomla_price.required' => 'سعر الجملة المطلوب.',
            'gomla_price.numeric' => 'سعر الجملة يجب أن يكون رقمًا.',
            'gomla_price.min' => 'سعر الجملة يجب أن يكون أكبر من أو يساوي 0.',
            'does_has_retail_unit.boolean' => 'وحدة التجزئة يجب أن تكون صحيحة أو خاطئة.',

            // Dependent fields when 'does_has_retail_unit' is true
            'retail_uom_id.required_if' => 'وحدة القياس للتجزئة مطلوبة عند تحديد وحدة تجزئة.',
            'retail_uom_id.exists' => 'وحدة القياس للتجزئة غير موجودة.',
            'retail_uom_qty_to_parent.required_if' => 'الكمية اللازمة للتجزئة مطلوبة.',
            'retail_uom_qty_to_parent.numeric' => 'الكمية اللازمة للتجزئة يجب أن تكون رقمًا.',
            'retail_uom_qty_to_parent.min' => 'الكمية اللازمة للتجزئة يجب أن تكون أكبر من أو تساوي 1.',
            'cost_price_retail.required_if' => 'سعر التكلفة للتجزئة مطلوب.',
            'cost_price_retail.numeric' => 'سعر التكلفة للتجزئة يجب أن يكون رقمًا.',
            'cost_price_retail.min' => 'سعر التكلفة للتجزئة يجب أن يكون أكبر من أو يساوي 0.',
            'price_retail.required_if' => 'السعر للتجزئة مطلوب.',
            'price_retail.numeric' => 'السعر للتجزئة يجب أن يكون رقمًا.',
            'price_retail.min' => 'السعر للتجزئة يجب أن يكون أكبر من أو يساوي 0.',
            'nos_gomla_price_retail.required_if' => 'سعر الجملة للتجزئة مطلوب.',
            'nos_gomla_price_retail.numeric' => 'سعر الجملة للتجزئة يجب أن يكون رقمًا.',
            'nos_gomla_price_retail.min' => 'سعر الجملة للتجزئة يجب أن يكون أكبر من أو يساوي 0.',
            'gomla_price_retail.required_if' => 'سعر الجملة للتجزئة مطلوب.',
            'gomla_price_retail.numeric' => 'سعر الجملة للتجزئة يجب أن يكون رقمًا.',
            'gomla_price_retail.min' => 'سعر الجملة للتجزئة يجب أن يكون أكبر من أو يساوي 0.',
        ];
    }

    /**
     * Get the validated data with additional fields.
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return array
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        return array_merge($validated, [
            'updated_by' => auth()->id(),
        ]);
    }
}
