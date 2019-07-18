<div>
    @foreach($roles as $role)
        <a class="btn btn-info btn-xs" href="{!! route('administration.roles.show',$role->id) !!}">{{ $role->name  }}</a>
    @endforeach
</div>
