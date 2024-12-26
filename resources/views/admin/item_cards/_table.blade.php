<div class="table-container">

    <table class="table table-bordered">
        <thead class="custom_thead">
            <tr>
                <th>مسلسل</th>
                <th>الاسم </th>
                <th> النوع </th>
                <th> الفئة</th>
                <th> الصنف الاب</th>
                <th> الوحدة الاب</th>
                <th> الوحدة التجزئة</th>
                <th> حالة التفعيل</th>
                <th class="text-center">-</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $info)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $info->name }}</td>
                    <td>{{ $info->item_type }}</td>
                    <td>{{ $info->category->name }}</td>
                    <td>{{ $info->parent->name ?? 'لا يوجد' }}</td>
                    <td>{{ $info->unit->name }}</td>
                    <td>{{ $info->retailUnit->name }}</td>
                    <td>{{ $info->active == 1 ? 'مفعل' : 'معطل' }}</td>

                   
                    <td style="width: 12%">
                        <a href="{{ route('admin.item-cards.edit', $info->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                        <form action="{{ route('admin.item-cards.destroy', $info->id) }}" method="POST"
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
