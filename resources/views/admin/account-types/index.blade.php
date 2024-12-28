@extends('layouts.admin')

@section('title', ' الحسابات')

@section('content_header', 'انواع الحسابات')

@section('content_header_link')
    <a href="{{ route('admin.account-types.index') }}">انواع الحسابات</a>
@endsection

@section('content_header_active', 'عرض')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">بيانات انواع الحسابات</h3>
                    <a href="{{ route('admin.uoms.create') }}" class="btn btn-sm btn-success">اضافة نوع</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" id="search" placeholder="بحث بالاسم" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <select id="is_master" class="form-control">
                                <option value="">الكل</option>
                                <option value="1">وحدة اب</option>
                                <option value="0">وحدة تجزئه</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    @if (@isset($data) && !@empty($data))
                        @include('admin.account-types._table', ['data' => $data])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script src="{{ asset('assets/admin/js/uom.js') }}"></script> --}}
@endsection
