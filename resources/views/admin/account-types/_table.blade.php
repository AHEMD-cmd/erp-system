<div class="table-container">

    <table class="table table-bordered">
        <thead class="custom_thead">
            <tr>
                <th>مسلسل</th>
                <th>الاسم </th>
                <th>حالة التفعيل</th>
                <th>  هل يضاف من شاشاة الحسابات</th>
               
                {{-- <th></th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $info)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $info->name }}</td>
                    <td>{{ $info->active == 1 ? 'مفعل' : 'معطل' }}</td>
                    <td>{{ $info->related_to_internal_accounts == 1 ? ' نعم وسضاف من شاشته' : ' لا ويضاف من شاشاة الحسابات' }}</td>

                  
                   
                    // <td>
                    //     <a href="{{ route('admin.uoms.edit', $info->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                    //     <form action="{{ route('admin.uoms.destroy', $info->id) }}" method="POST"
                    //         style="display: inline-block;"
                    //         onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا المخزن')">
                    //         @csrf
                    //         @method('DELETE')
                    //         <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                    //     </form>
                    // </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    
</div>
