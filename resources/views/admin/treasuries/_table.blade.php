<div class="table-container">
    
    <table class="table table-bordered">
        <thead class="custom_thead">
            <tr>
                <th>مسلسل</th>
                <th>اسم الخزنة</th>
                <th>هل رئيسية</th>
                <th>اخر ايصال صرف</th>
                <th>اخر ايصال تحصيل</th>
                <th>حالة التفعيل</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $info)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $info->name }}</td>
                    <td>{{ $info->is_master == 1 ? 'رئيسية' : 'فرعية' }}</td>
                    <td>{{ $info->last_isal_exchange }}</td>
                    <td>{{ $info->last_isal_collect }}</td>
                    <td>{{ $info->active == 1 ? 'مفعل' : 'معطل' }}</td>
                    <td>
                        <a href="{{ route('admin.treasuries.edit', $info->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                        <a href="{{ route('admin.treasuries.show', $info->id) }}" class="btn btn-sm btn-info">المزيد</a>
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
