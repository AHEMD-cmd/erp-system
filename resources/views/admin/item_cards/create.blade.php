@extends('layouts.admin')

@section('title', 'إضافة صنف جديد')

@section('content_header', 'الأصناف')

@section('content_header_link')
    <a href="{{ route('admin.item-cards.index') }}">الأصناف</a>
@endsection

@section('content_header_active', 'إضافة')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-header">
                    <h3 class="card-title card_title_center">إضافة صنف جديد</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.item-cards.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Name -->
                            <div class="form-group col-md-6">
                                <label for="name">اسم الصنف</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="أدخل اسم الصنف" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Item Type -->
                            <div class="form-group col-md-6">
                                <label for="item_type">نوع الصنف</label>
                                <select name="item_type" id="item_type"
                                    class="form-control @error('item_type') is-invalid @enderror" required>
                                    <option value="مخزني" {{ old('item_type') == 'مخزني' ? 'selected' : '' }}> مخزني
                                    </option>
                                    <option value="عهدة" {{ old('item_type') == 'عهدة' ? 'selected' : '' }}> عهدة</option>
                                    <option value="استهلاكي" {{ old('item_type') == 'استهلاكي' ? 'selected' : '' }}>
                                        استهلاكي
                                    </option>
                                </select>
                                @error('item_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Photo -->
                            <div class="form-group col-md-6">
                                <label for="photo">الصورة</label>
                                <input type="file" name="photo" id="photo"
                                    class="form-control-file @error('photo') is-invalid @enderror">
                                @error('photo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Item Card Category -->
                            <div class="form-group col-md-6">
                                <label for="item_card_category_id">الفئة</label>
                                <select name="item_card_category_id" id="item_card_category_id"
                                    class="form-control @error('item_card_category_id') is-invalid @enderror" required>
                                    <option value="">اختر الفئة</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('item_card_category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('item_card_category_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Parent ID -->
                            <div class="form-group col-md-6">
                                <label for="parent_id">الصنف الاب</label>
                                <select name="parent_id" id="parent_id"
                                    class="form-control @error('parent_id') is-invalid @enderror">
                                    <option value="">بدون صنف رئيسي</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}"
                                            {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                            {{ $parent->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Item Code -->
                            <div class="form-group col-md-6">
                                <label for="item_code">كود الصنف</label>
                                <input type="text" name="item_code" id="item_code"
                                    class="form-control @error('item_code') is-invalid @enderror"
                                    value="{{ old('item_code') }}" placeholder="أدخل كود الصنف" required>
                                @error('item_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Barcode -->
                            <div class="form-group col-md-6">
                                <label for="barcode">الباركود</label>
                                <input type="text" name="barcode" id="barcode"
                                    class="form-control @error('barcode') is-invalid @enderror"
                                    value="{{ old('barcode') }}" placeholder="أدخل الباركود">
                                @error('barcode')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Fixed Price -->
                            <div class="form-group col-md-6">
                                <label for="has_fixed_price">هل السعر ثابت؟</label>
                                <select name="has_fixed_price" id="has_fixed_price"
                                    class="form-control @error('has_fixed_price') is-invalid @enderror">
                                    <option value="1" {{ old('has_fixed_price') == '1' ? 'selected' : '' }}>نعم
                                    </option>
                                    <option value="0" {{ old('has_fixed_price') == '0' ? 'selected' : '' }}>لا
                                    </option>
                                </select>
                                @error('has_fixed_price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- UOM -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="uom_id">وحدة القياس الاساسة</label>
                                    <select name="uom_id" id="uom_id"
                                        class="form-control @error('uom_id') is-invalid @enderror" required>
                                        <option value="">اختر الوحدة</option>
                                        @foreach ($uoms as $uom)
                                            <option value="{{ $uom->id }}"
                                                {{ old('uom_id') == $uom->id ? 'selected' : '' }}>
                                                {{ $uom->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('uom_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Dependent Fields -->
                        <div class="row" id="dependent-fields"
                            @if (old('uom_id') == '') style="display: none;" @endif>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cost_price">سعر التكلفة</label>
                                    <input type="number" name="cost_price" id="cost_price"
                                        class="form-control @error('cost_price') is-invalid @enderror"
                                        value="{{ old('cost_price') }}" placeholder="أدخل سعر التكلفة">
                                    @error('cost_price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">السعر</label>
                                    <input type="number" name="price" id="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" placeholder="أدخل السعر">
                                    @error('price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nos_gomla_price">سعر نص الجملة</label>
                                    <input type="number" name="nos_gomla_price" id="nos_gomla_price"
                                        class="form-control @error('nos_gomla_price') is-invalid @enderror"
                                        value="{{ old('nos_gomla_price') }}" placeholder="أدخل سعر نص الجملة">
                                    @error('nos_gomla_price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gomla_price">سعر الجملة</label>
                                    <input type="number" name="gomla_price" id="gomla_price"
                                        class="form-control @error('gomla_price') is-invalid @enderror"
                                        value="{{ old('gomla_price') }}" placeholder="أدخل سعر الجملة">
                                    @error('gomla_price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Does Has Retail Unit -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="does_has_retail_unit">هل يوجد وحدة تجزئة؟</label>
                                <select name="does_has_retail_unit" id="does_has_retail_unit"
                                    class="form-control @error('does_has_retail_unit') is-invalid @enderror">

                                    <option value="0" {{ old('does_has_retail_unit') == '0' ? 'selected' : '' }}>لا
                                    </option>
                                    <option value="1" {{ old('does_has_retail_unit') == '1' ? 'selected' : '' }}>نعم
                                    </option>
                                </select>
                                @error('does_has_retail_unit')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <!-- Retail Dependent Fields -->
                        <div class="row" id="retail-dependent-fields"
                            @if (old('does_has_retail_unit') == '') style="display: none;" @endif>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="retail_uom_id">وحدة التجزئة</label>
                                    <select name="retail_uom_id" id="retail_uom_id"
                                        class="form-control @error('retail_uom_id') is-invalid @enderror">
                                        <option value="">اختر وحدة التجزئة</option>
                                        @foreach ($retailUoms as $retailUom)
                                            <option value="{{ $retailUom->id }}"
                                                {{ old('retail_uom_id') == $retailUom->id ? 'selected' : '' }}>
                                                {{ $retailUom->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('retail_uom_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="retail_uom_qty_to_parent"> عدد وحدات التجزئة بوحدة <span
                                            id="parent_uom"></span> </label>
                                    <input type="number" name="retail_uom_qty_to_parent" id="retail_uom_qty_to_parent"
                                        class="form-control @error('retail_uom_qty_to_parent') is-invalid @enderror"
                                        value="{{ old('retail_uom_qty_to_parent') }}">
                                    @error('retail_uom_qty_to_parent')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cost_price_retail">تكلفة وحدة التجزئة</label>
                                    <input type="number" step="0.01" name="cost_price_retail" id="cost_price_retail"
                                        class="form-control @error('cost_price_retail') is-invalid @enderror"
                                        value="{{ old('cost_price_retail') }}">
                                    @error('cost_price_retail')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price_retail">سعر البيع لوحدة التجزئة</label>
                                    <input type="number" step="0.01" name="price_retail" id="price_retail"
                                        class="form-control @error('price_retail') is-invalid @enderror"
                                        value="{{ old('price_retail') }}">
                                    @error('price_retail')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nos_gomla_price_retail">سعر نصف الجملة لوحدة التجزئة</label>
                                    <input type="number" step="0.01" name="nos_gomla_price_retail"
                                        id="nos_gomla_price_retail"
                                        class="form-control @error('nos_gomla_price_retail') is-invalid @enderror"
                                        value="{{ old('nos_gomla_price_retail') }}">
                                    @error('nos_gomla_price_retail')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gomla_price_retail">سعر الجملة لوحدة التجزئة</label>
                                    <input type="number" step="0.01" name="gomla_price_retail"
                                        id="gomla_price_retail"
                                        class="form-control @error('gomla_price_retail') is-invalid @enderror"
                                        value="{{ old('gomla_price_retail') }}">
                                    @error('gomla_price_retail')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">حفظ</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/admin/js/item_card.js') }}"></script>
@endsection
