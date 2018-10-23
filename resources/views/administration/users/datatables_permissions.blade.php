<div>
    @foreach($permissions as $permission)
        <a class="btn btn-success btn-xs" href="{!! route('administration.permissions.show',$permission->id) !!}">{{ $permission->name  }}</a>
    @endforeach
</div>
