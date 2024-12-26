@extends('layouts.admin')

@section('title', 'إضافة مخزن جديد')

@section('content_header', 'المخازن')

@section('content_header_link')
    <a href="{{ route('admin.stores.index') }}"> المخازن</a>
@endsection

@section('content_header_active', 'إضافة')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center"> إضافة مخزن جديد </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form action="{{ route('admin.stores.store') }}" method="POST">
                        @csrf

                        <!-- Store Name -->
                        <div class="form-group">
                            <label for="name">اسم المخزن</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="أدخل اسم المخزن"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label for="phone">رقم الهاتف</label>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror" placeholder="أدخل رقم الهاتف"
                                value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label for="address">العنوان</label>
                            <input type="text" name="address" id="address"
                                class="form-control @error('address') is-invalid @enderror" placeholder="أدخل العنوان"
                                value="{{ old('address') }}" required>
                            @error('address')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Active Status -->
                        <div class="form-group">
                            <label for="active">حالة التفعيل</label>
                            <select name="active" id="active" class="form-control @error('active') is-invalid @enderror"
                                required>
                                <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>مفعل</option>
                                <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>معطل</option>
                            </select>
                            @error('active')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">حفظ</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
