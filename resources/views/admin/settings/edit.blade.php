@extends('layouts.admin')

@section('title', 'الضبط العام ')

@section('content_header', 'الضبط')

@section('content_header_link')

    <a href="{{ route('admin.settings.index') }}">الضبط</a>

@endsection

@section('content_header_active', 'عرض')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">بيانات الضبط العام</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form action="{{ route('admin.settings.update', 1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- System Name -->
                        <div class="form-group">
                            <label for="system_name">اسم النظام</label>
                            <input type="text" name="system_name" id="system_name"
                                class="form-control @error('system_name') is-invalid @enderror"
                                value="{{ old('system_name', $setting->system_name) }}">
                            @error('system_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Photo -->
                       

                        <div class="form-group">
                            <label for="parent_account_number">الحساب الاب للعملاء</label>
                            <select name="customer_parent_account_number" id="customer_parent_account_number"
                                class="form-control @error('customer_parent_account_number') is-invalid @enderror" required>
                                <option value="">اختر الحساب</option>
                                @foreach ($parentAccounts as $one)
                                    <option value="{{ $one->account_number }}"
                                        {{ old('customer_parent_account_number', $setting->parent_account_number) == $one->account_number ? 'selected' : '' }}>
                                        {{ $one->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_parent_account_number')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- General Alert -->
                        <div class="form-group">
                            <label for="general_alert">التنبيه العام</label>
                            <textarea name="general_alert" id="general_alert" class="form-control @error('general_alert') is-invalid @enderror"
                                rows="4">{{ old('general_alert', $setting->general_alert) }}</textarea>
                            @error('general_alert')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label for="address">العنوان</label>
                            <input type="text" name="address" id="address"
                                class="form-control @error('address') is-invalid @enderror"
                                value="{{ old('address', $setting->address) }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label for="phone">رقم الهاتف</label>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $setting->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="photo">الصورة</label>
                            <input type="file" name="photo" id="photo"
                                class="form-control-file @error('photo') is-invalid @enderror">
                            @error('photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            @if ($setting->photo)
                                <img src="{{ asset($setting->photo) }}" alt="Current Photo" class="mt-2"
                                    style="max-width: 200px;">
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">تحديث</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
