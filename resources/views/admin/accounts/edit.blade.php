@extends('layouts.admin')

@section('title', 'تعديل الحساب')

@section('content_header', 'تعديل الحساب المالي')

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
                    <h3 class="card-title card_title_center">تعديل الحساب المالي</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.accounts.update', $account->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Name -->
                            <div class="form-group col-md-6">
                                <label for="name">الاسم </label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $account->name) }}"
                                    placeholder="أدخل اسم الحساب" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Account Type -->
                            <div class="form-group col-md-6">
                                <label for="account_type">نوع الحساب</label>
                                <select name="account_type_id" id="account_type"
                                    class="form-control @error('account_type') is-invalid @enderror" required>
                                    @foreach ($accountTypes as $one)
                                        <option value="{{ $one->id }}"
                                            {{ old('account_type_id', $account->account_type_id) == $one->id ? 'selected' : '' }}>
                                            {{ $one->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('account_type_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Item Code -->
                            <div class="form-group col-md-6">
                                <label for="notes">الملاحظات</label>
                                <textarea type="text" name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror"
                                    placeholder="أدخل الملاحظات">{{ old('notes', $account->notes) }}</textarea>
                                @error('notes')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Active Status -->
                            <div class="form-group col-md-6">
                                <label for="active">حالة التفعيل</label>
                                <select name="active" id="active"
                                    class="form-control @error('active') is-invalid @enderror" required>
                                    <option value="1" {{ old('active', $account->active) == '1' ? 'selected' : '' }}>مفعل</option>
                                    <option value="0" {{ old('active', $account->active) == '0' ? 'selected' : '' }}>معطل</option>
                                </select>
                                @error('active')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- is parent -->
                            <div class="form-group col-md-6">
                                <label for="is_parent"> هل الحساب اب</label>
                                <select name="is_parent" id="is_parent"
                                    class="form-control @error('is_parent') is-invalid @enderror" required>
                                    <option value="1" {{ old('is_parent', $account->is_parent) == '1' ? 'selected' : '' }}>نعم</option>
                                    <option value="0" {{ old('is_parent', $account->is_parent) == '0' ? 'selected' : '' }}>لا</option>
                                </select>
                                @error('is_parent')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- parent_account_number -->
                            <div class="form-group col-md-6">
                                <label for="parent_account_number">الحساب الاب</label>
                                <select name="parent_account_number" id="parent_account_number"
                                    class="form-control @error('parent_account_number') is-invalid @enderror" required>
                                    <option value="">اختر الحساب</option>
                                    @foreach ($parentAccounts as $one)
                                        <option value="{{ $one->account_number }}"
                                            {{ old('parent_account_number', $account->parent_account_number) == $one->account_number ? 'selected' : '' }}>
                                            {{ $one->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_account_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-success">تحديث</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/accounts.js') }}"></script>
@endsection
