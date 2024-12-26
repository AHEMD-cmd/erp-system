@extends('layouts.admin')

@section('title', 'ضبط المخازن')

@section('content_header', 'الاصناف')

@section('content_header_link')
    <a href="{{ route('admin.uoms.index') }}">الاصناف</a>
@endsection

@section('content_header_active', 'عرض')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">بيانات الاصناف</h3>
                    <a href="{{ route('admin.item-cards.create') }}" class="btn btn-sm btn-success">اضافة صنف</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" id="search" placeholder="بحث بالاسم، الباركود أو الكود"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <select id="category_id" class="form-control">
                                <option value=""> الفئة</option>
                                <!-- Dynamically populate categories -->
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select id="item_type" class="form-control">
                                <option value=""> النوع</option>
                                <option value="مخزني">مخزني</option>
                                <option value="عهدة">عهدة</option>
                                <option value="استهلاكي">استهلاكي</option>
                                <!-- Add additional options as needed -->
                            </select>
                        </div>
                    </div>

                    <br>
                    @if (@isset($data) && !@empty($data))
                        @include('admin.item_cards._table', ['data' => $data])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/item_card.js') }}"></script>
@endsection
