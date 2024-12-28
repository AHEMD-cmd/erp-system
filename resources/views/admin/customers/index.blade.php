@extends('layouts.admin')

@section('title', 'العملاء')

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
                    <h3 class="card-title card_title_center">بيانات  العملاء </h3>
                    <a href="{{ route('admin.customers.create') }}" class="btn btn-sm btn-success">اضافة عميل</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <input  type="radio" checked name="searchbyradio" id="searchbyradio" value="customer_code"> برقم العميل
                            <input  type="radio"  name="searchbyradio" id="searchbyradio" value="account_number"> برقم الحساب
                            <input  type="radio" name="searchbyradio" id="searchbyradio" value="name"> بالاسم
                            <input autofocus style="margin-top: 6px !important;" type="text" id="search_by_text" placeholder=" اسم  - رقم الحساب  - كود العميل" class="form-control"> <br>
                         </div>
                    </div>

                    <br>
                    @if (@isset($data) && !@empty($data))
                        @include('admin.customers._table', ['data' => $data])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/customers.js') }}"></script>
@endsection
