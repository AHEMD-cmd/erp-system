@extends('layouts.admin')

@section('title', 'الضبط العام')

@section('content_header', 'فئات الأصناف')

@section('content_header_link')
    <a href="{{ route('admin.sales-material-types.index') }}">فئات الأصناف</a>
@endsection

@section('content_header_active', 'عرض')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">بيانات فئات الأصناف</h3>
                    <a href="{{ route('admin.item-card-categories.create') }}" class="btn btn-sm btn-success">إضافة فئة أصناف</a>
                </div>
                <div class="card-body">
                    {{-- Uncomment the following if a search input is needed --}}
                    {{-- <div class="col-md-4">
                        <input type="text" id="search" placeholder="بحث بالاسم" class="form-control">
                    </div> --}}
                    <br>
                    @if (isset($data) && $data->isNotEmpty())
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
                                                {{ $info->created_at->format('A') === 'AM' ? 'صباحًا' : 'مساءً' }}
                                                بواسطة {{ $info->creator->name ?? 'غير متوفر' }}
                                            </td>
                                            <td>
                                                @if ($info->updated_at)
                                                    {{ $info->updated_at->format('Y-m-d h:i') }}
                                                    <br>
                                                    {{ $info->updated_at->format('A') === 'AM' ? 'صباحًا' : 'مساءً' }}
                                                    بواسطة {{ $info->updater->name ?? 'غير متوفر' }}
                                                @else
                                                    لم يتم تحديثه
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.item-card-categories.edit', $info->id) }}"
                                                    class="btn btn-sm btn-primary">تعديل</a>
                                                <form
                                                    action="{{ route('admin.item-card-categories.destroy', $info->id) }}"
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
                        <div class="alert alert-info text-center">لا توجد بيانات متوفرة.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
