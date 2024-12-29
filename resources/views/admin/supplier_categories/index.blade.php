@extends('layouts.admin')

@section('title', 'الضبط العام')

@section('content_header', 'فئات الموردين')

@section('content_header_link')
    <a href="{{ route('admin.supplier-categories.index') }}">فئات الموردين</a>
@endsection

@section('content_header_active', 'عرض')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">بيانات فئات الموردين</h3>
                    <a href="{{ route('admin.supplier-categories.create') }}" class="btn btn-sm btn-success">إضافة فئة موردين</a>
                </div>
                <div class="card-body">
                    <br>
                    @if (@isset($data) && !@empty($data))
                        <div class="table-container">
                            <table class="table table-bordered">
                                <thead class="custom_thead">
                                    <tr>
                                        <th>مسلسل</th>
                                        <th>اسم الفئة</th>
                                        <th>حالة التفعيل</th>
                                        <th>تاريخ الإضافة</th>
                                        <th>تاريخ التحديث</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $i => $info)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $info->name }}</td>
                                            <td>{{ $info->active ? 'مفعل' : 'معطل' }}</td>
                                            <td>
                                                {{ $info->created_at->format('Y-m-d h:i') }}
                                                <br>
                                                {{ $info->created_at->format('A') == 'AM' ? 'صباحاً' : 'مساءً' }}
                                                بواسطة {{ $info->creator->name ?? 'غير متوفر' }}
                                            </td>
                                            <td>
                                                @if ($info->updated_at != null)
                                                    {{ $info->updated_at->format('Y-m-d h:i') }}
                                                    <br>
                                                    {{ $info->updated_at->format('A') == 'AM' ? 'صباحاً' : 'مساءً' }}
                                                    بواسطة {{ $info->updater->name ?? 'غير متوفر' }}
                                                @else
                                                    لم يتم تحديثه
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.supplier-categories.edit', $info->id) }}"
                                                    class="btn btn-sm btn-primary">تعديل</a>
                                                <form
                                                    action="{{ route('admin.supplier-categories.destroy', $info->id) }}"
                                                    method="POST"
                                                    style="display: inline-block;"
                                                    onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذه الفئة؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">لا توجد بيانات متوفرة.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
