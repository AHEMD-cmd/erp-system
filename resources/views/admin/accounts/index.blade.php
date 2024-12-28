@extends('layouts.admin')

@section('title', 'الحسابات')

@section('content_header', 'الحسابات المالية')

@section('content_header_link')
    <a href="{{ route('admin.accounts.index') }}">الحسابات المالية</a>
@endsection

@section('content_header_active', 'عرض')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">بيانات الشجرة المحاسبية ( الحسابات المالية )</h3>
                    <a href="{{ route('admin.accounts.create') }}" class="btn btn-sm btn-success">اضافة حساب</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="radio" checked name="searchbyradio" id="searchbyradio" value="account_number">
                            برقم الحساب
                            <input type="radio" name="searchbyradio" id="searchbyradio" value="name"> بالاسم
                            <input style="margin-top: 6px !important;" type="text" id="search_by_text"
                                placeholder=" اسم  - رقم الحساب" class="form-control"> <br>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> بحث بنوع الحساب</label>
                                <select name="account_type_id" id="account_type_id" class="form-control ">
                                    <option value="all"> بحث بالكل</option>
                                    @if (@isset($accountTypes) && !@empty($accountTypes))
                                        @foreach ($accountTypes as $info)
                                            <option value="{{ $info->id }}"> {{ $info->name }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> هل الحساب أب</label>
                                <select name="is_parent" id="is_parent" class="form-control">
                                    <option value="all"> بحث بالكل</option>
                                    <option value="1"> نعم</option>
                                    <option value="0"> لا</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> حالة التفعيل </label>
                                <select name="active" id="active" class="form-control">
                                    <option value="all"> بحث بالكل</option>
                                    <option value="1"> مفعل </option>
                                    <option value="0"> معطل ومؤرشف</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>
                    @if (@isset($data) && !@empty($data))
                        @include('admin.accounts._table', ['data' => $data])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/accounts.js') }}"></script>
@endsection
