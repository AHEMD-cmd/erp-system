@extends('layouts.admin')

@section('title', 'اضافة خزنة جديدة')

@section('content_header', 'الخزن')

@section('content_header_link')

    <a href="{{ route('admin.treasuries.index') }}">الخزن</a>

@endsection

@section('content_header_active', 'اضافة')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center"> اضافة خزنة جديدة </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form action="{{ route('admin.treasuries.store') }}" method="POST">
                        @csrf

                        <!-- Treasury Name -->
                        <div class="form-group">
                            <label for="name">اسم الخزنة</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="أدخل اسم الخزنة"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Is Master -->
                        <div class="form-group">
                            <label for="is_master">هل رئيسية</label>
                            <select name="is_master" id="is_master"
                                class="form-control @error('is_master') is-invalid @enderror" required>
                                <option value="1" {{ old('is_master') == '1' ? 'selected' : '' }}>نعم</option>
                                <option value="0" {{ old('is_master') == '0' ? 'selected' : '' }}>لا</option>
                            </select>
                            @error('is_master')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Last Isal Exchange -->
                        <div class="form-group">
                            <label for="last_isal_exchange">آخر إيصال صرف</label>
                            <input type="number" step="0.01" name="last_isal_exchange" id="last_isal_exchange"
                                class="form-control @error('last_isal_exchange') is-invalid @enderror"
                                placeholder="أدخل آخر إيصال صرف" value="{{ old('last_isal_exchange') }}" required>
                            @error('last_isal_exchange')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Last Isal Collect -->
                        <div class="form-group">
                            <label for="last_isal_collect">آخر إيصال تحصيل</label>
                            <input type="number" step="0.01" name="last_isal_collect" id="last_isal_collect"
                                class="form-control @error('last_isal_collect') is-invalid @enderror"
                                placeholder="أدخل آخر إيصال تحصيل" value="{{ old('last_isal_collect') }}" required>
                            @error('last_isal_collect')
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

                        <!-- Parent Treasury -->
                        <div class="form-group">
                            <label for="parent_id">الخزنة الرئيسية</label>
                            <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                <option value="">اختياري</option>
                                @foreach($treasuries as $treasury)
                                    <option value="{{ $treasury->id }}" {{ old('parent_id') == $treasury->id ? 'selected' : '' }}>
                                        {{ $treasury->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
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
