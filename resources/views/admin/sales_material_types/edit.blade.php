@extends('layouts.admin')

@section('title', 'تعديل فئة فواتير')

@section('content_header', 'فئة الفواتير')

@section('content_header_link')

    <a href="{{ route('admin.sales-material-types.index') }}">فئة الفواتير</a>

@endsection

@section('content_header_active', 'تعديل')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">تعديل فئة فواتير</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form action="{{ route('admin.sales-material-types.update', $salesMaterialType->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- This is necessary for the update method -->

                        <!-- Sales Material Name -->
                        <div class="form-group">
                            <label for="name">اسم الفئة</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="أدخل اسم نوع المادة"
                                value="{{ old('name', $salesMaterialType->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Active Status -->
                        <div class="form-group">
                            <label for="active">حالة التفعيل</label>
                            <select name="active" id="active" class="form-control @error('active') is-invalid @enderror"
                                required>
                                <option value="1" {{ old('active', $salesMaterialType->active) == '1' ? 'selected' : '' }}>مفعل</option>
                                <option value="0" {{ old('active', $salesMaterialType->active) == '0' ? 'selected' : '' }}>معطل</option>
                            </select>
                            @error('active')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">حفظ التعديلات</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
