@extends('layouts.admin')

@section('title', 'الضبط العام')

@section('content_header', 'الوحدات')

@section('content_header_link')
    <a href="{{ route('admin.uoms.index') }}">الوحدات</a>
@endsection

@section('content_header_active', 'عرض')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">بيانات الوحدات</h3>
                    <a href="{{ route('admin.uoms.create') }}" class="btn btn-sm btn-success">اضافة وحدة</a>
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
                        @include('admin.uoms._table', ['data' => $data])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/uom.js') }}"></script>
@endsection
