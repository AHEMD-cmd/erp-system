<div class="table-container">

    <table class="table table-bordered">
        <thead class="custom_thead">
            <tr>
                <th>مسلسل</th>
                <th>الاسم</th>
                <th>الكود </th>
                <th> رقم الحساب </th>
                <th> الرصيد</th>
                <th> التفعيل</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $info)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $info->name }}</td>
                    <td>{{ $info->customer_code }}</td>
                    <td>{{ $info->account_number }}</td>
                    <td></td>
                    <td>{{ $info->active == 1 ? 'مفعل' : 'معطل' }}</td>

                   
                    <td style="width: 12%">
                        <a href="{{ route('admin.customers.edit', $info->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                        <form action="{{ route('admin.customers.destroy', $info->id) }}" method="POST"
                            style="display: inline-block;"
                            onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا العميل')">
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
