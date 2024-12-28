@extends('layouts.admin')

@section('title', 'تعديل حساب')

@section('content_header', 'الحسابات المالية')

@section('content_header_link')
    <a href="{{ route('admin.accounts.index') }}">الحسابات المالية</a>
@endsection

@section('content_header_active', 'تعديل')

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
                    <h3 class="card-title card_title_center">تعديل حساب مالي</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Name -->
                            <div class="form-group col-md-6">
                                <label for="name">الاسم </label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $customer->name) }}"
                                    placeholder="أدخل اسم العميل" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="form-group col-md-6">
                                <label for="address">العنوان</label>
                                <input type="text" name="address" id="address"
                                    class="form-control @error('address') is-invalid @enderror" placeholder="أدخل العنوان"
                                    value="{{ old('address', $customer->address) }}">
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Active Status -->
                            <div class="form-group col-md-6">
                                <label for="active">حالة التفعيل</label>
                                <select name="active" id="active"
                                    class="form-control @error('active') is-invalid @enderror" required>
                                    <option value="1" {{ old('active', $customer->active) == '1' ? 'selected' : '' }}>مفعل</option>
                                    <option value="0" {{ old('active', $customer->active) == '0' ? 'selected' : '' }}>معطل</option>
                                </select>
                                @error('active')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Notes -->
                            <div class="form-group col-md-6">
                                <label for="notes">الملاحظات</label>
                                <textarea type="text" name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror"
                                    placeholder="أدخل الملاحظات">{{ old('notes', $customer->notes) }}</textarea>
                                @error('notes')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary">تحديث</button>
                            </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/accounts.js') }}"></script>
@endsection
