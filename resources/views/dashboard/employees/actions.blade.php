<a href="{{route('employee.edit',$row['id'])}}" class="edit btn btn-primary btn-sm">Edit</a>
<form action="{{route('employee.destroy',$row['id'])}}" method="post">

    {{ csrf_field() }}
    {{ method_field('delete') }}


    <button type="submit" class="edit btn btn-danger btn-sm">
        delete
    </button>
</form>
