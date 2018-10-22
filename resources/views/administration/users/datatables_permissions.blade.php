<div>
    @foreach($permissions as $permission)
        {!! Form::label($permission->id, $permission->name) !!}
    @endforeach
</div>
