<div class="table-container">

    <table class="table table-bordered">
        <thead class="custom_thead">
            <tr>
                <th>مسلسل</th>
                <th>الاسم </th>
                <th> رقم الحساب </th>
                <th> النوع </th>
                <th>  هل أب </th>
                <th>  الحساب الاب </th>
                <th>  الرصيد </th>
                <th> التفعيل</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $info)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $info->name }}</td>
                    <td>{{ $info->account_number }}</td>
                    <td>{{ $info->accountType->name }}</td>
                    <td>{{ $info->is_parent == 1 ? 'نعم' : 'لا' }}</td>
                    <td>{{ $info->parent->name }}</td>
                    <td></td>
                    <td>{{ $info->active == 1 ? 'مفعل' : 'معطل' }}</td>

                   
                    <td style="width: 12%">
                        <a href="{{ route('admin.accounts.edit', $info->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                        <form action="{{ route('admin.accounts.destroy', $info->id) }}" method="POST"
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
