<div class="table-container">

    <table class="table table-bordered">
        <thead class="custom_thead">
            <tr>
                <th>مسلسل</th>
                <th>اسم الوحدة</th>
                <th> نوع الوحدة</th>
                <th>حالة التفعيل</th>
                <th>تاريخ الاضافة</th>
                <th>تاريخ التحديث</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $info)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $info->name }}</td>
                    <td>{{ $info->is_master == 1 ? 'وحدة اب' : 'وحدة تجزئه' }}</td>
                    <td>{{ $info->active == 1 ? 'مفعل' : 'معطل' }}</td>

                    <td>
                        {{ $info->created_at->format('Y-m-d h:i') }}
                        <br>
                        {{ $info->created_at->format('A') == 'AM' ? 'صباح' : 'مساء' }}
                        بواسطة {{ $info->creator->name ?? 'غير متوفر' }}
                    </td>
                    <td>
                        @if ($info->updated_at != null)
                            {{ $info->updated_at->format('Y-m-d h:i') }}
                            <br>

                            {{ $info->updated_at->format('A') == 'AM' ? 'صباح' : 'مساء' }}
                            بواسطة {{ $info->updater->name ?? 'غير متوفر' }}
                        @else
                            لم يتم تحديثه
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.uoms.edit', $info->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                        <form action="{{ route('admin.uoms.destroy', $info->id) }}" method="POST"
                            style="display: inline-block;"
                            onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا المخزن')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <div class="pagination-wrapper">
        {{ $data->links() }}
    </div>
</div>
