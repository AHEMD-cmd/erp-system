@extends('layouts.admin')

@section('title', 'الضبط العام')

@section('content_header', 'الخزن')

@section('content_header_link')
    <a href="{{ route('admin.treasuries.index') }}">الخزن</a>
@endsection

@section('content_header_active', 'عرض')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">بيانات الخزن</h3>
                    <a href="{{ route('admin.treasuries.create') }}" class="btn btn-sm btn-success">اضافة خزنة</a>
                </div>
                <div class="card-body">
                    <div class="col-md-4">
                        <input type="text" id="search" placeholder="بحث بالاسم" class="form-control">
                    </div>
                    <br>
                    @if (@isset($data) && !@empty($data))
                        @include('admin.treasuries._table', ['data' => $data])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/treasury.js') }}"></script>
@endsection
