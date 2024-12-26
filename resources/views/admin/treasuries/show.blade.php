@extends('layouts.admin')

@section('title', 'عرض الخزنة')

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
                    <h3 class="card-title card_title_center">بيانات الخزنة</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (@isset($treasury) && !@empty($treasury))
                        <table id="example2" class="table table-bordered table-hover">
                            <tr>
                                <td class="width30">اسم الخزنة</td>
                                <td>{{ $treasury->name }}</td>
                            </tr>
                            <tr>
                                <th class="width30">اخر ايصال صرف</th>

                                <td>{{ $treasury->last_isal_exchange }}</td>
                            </tr>
                            <tr>
                                <th class="width30">اخر ايصال تحصيل</th>
                                <td>{{ $treasury->last_isal_collect }}</td>
                            </tr>
                            <tr>
                                <td class="width30">الحالة</td>
                                <td>{{ $treasury->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                            </tr>
                            <tr>
                                <td class="width30">هل رئيسية</td>
                                <td>{{ $treasury->is_master == 1 ? 'نعم' : 'لا' }}</td>
                            </tr>
                            <tr>
                                <td class="width30">تاريخ الاضافة</td>
                                <td>
                                    {{ $treasury->created_at->format('Y-m-d h:i') }}
                                    {{ $treasury->created_at->format('A') == 'AM' ? 'صباح' : 'مساء' }}
                                    بواسطة {{ $treasury->updater->name ?? 'غير متوفر' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="width30">تاريخ اخر تحديث</td>
                                <td>
                                    {{ $treasury->updated_at->format('Y-m-d h:i') }}
                                    {{ $treasury->updated_at->format('A') == 'AM' ? 'صباح' : 'مساء' }}
                                    بواسطة {{ $treasury->updater->name ?? 'غير متوفر' }}
                                </td>
                            </tr>
                        </table>
                    @else
                        <div class="alert alert-danger">
                            لا توجد بيانات
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sub-Treasuries Table -->
            @if ($treasury->subTreasuries && $treasury->subTreasuries->isNotEmpty())
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title card_title_center">الخزن الفرعية</h3>
                    </div>
                    <div class="card-body">
                        <table id="subTreasuriesTable" class="table table-bordered table-hover">
                            <thead class="custom_thead">
                                <tr>
                                    <th>#</th>
                                    <th>اسم الخزنة</th>
                                    <th>الحالة</th>
                                    <th>تاريخ الاضافة</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($treasury->subTreasuries as $index => $subTreasury)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $subTreasury->name }}</td>
                                        <td>{{ $subTreasury->active == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                                        <td>
                                            {{ $subTreasury->created_at->format('Y-m-d h:i') }}
                                            {{ $subTreasury->created_at->format('A') == 'AM' ? 'صباح' : 'مساء' }}
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.treasuries.destroy', $subTreasury->id) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذه الخزنة؟')">
                                                    حذف
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="alert alert-warning mt-4">
                    لا توجد خزن فرعية لهذه الخزنة.
                </div>
            @endif
        </div>
    </div>
@endsection
