<div>
    @foreach($roles as $role)
        {!! Form::label($role->id, $role->name) !!}
    @endforeach
</div>
