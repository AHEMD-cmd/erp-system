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
                    @if (@isset($data) && !@empty($data))
                        <table id="example2" class="table table-bordered table-hover">
                            <tr>
                                <td class="width30">اسم الشركة</td>
                                <td > {{ $data->system_name }}</td>

                            </tr>
                            <tr>
                                <td class="width30">كود الشركة</td>
                                <td> {{ $data->company_code }}</td>

                            </tr>

                            <tr>
                                <td class="width30">حالة الشركة</td>
                                <td> {{ $data->active == 1 ? 'مفعل' : 'غير مفعل' }} </td>

                            </tr>

                            <tr>
                                <td class="width30"> عنوان الشركة </td>
                                <td> {{ $data->address }}</td>

                            </tr>
                            <tr>
                                <td class="width30"> هاتف الشركة </td>
                                <td > {{ $data->phone }}</td>

                            </tr>
                            <tr>
                                <td class="width30"> رسالة التنبيه اعلي الشاشة للشركة </td>
                                <td> {{ $data->general_alert }}</td>
                            </tr>

                            <tr>
                                <td class="width30"> لوجو الشركة </td>
                                <td>
                                    <div class="image">
                                        <img class="custom_img" src="{{asset($data->photo)}}" alt="لوجو الشركة">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="width30"> تاريخ اخر تحديث </td>
                                <td>
                                {{$data->updated_at->format('Y-m-d h:i')}}
                                {{$data->updated_at->format('A') == 'AM' ? 'صباح' : 'مساء'}}
                                بواسطة {{$data->updater->name}}
                                <a href="{{route('admin.settings.edit', $data->id)}}" class="btn btn-sm btn-success"> تعديل</a>
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
        </div>
    </div>
@endsection
