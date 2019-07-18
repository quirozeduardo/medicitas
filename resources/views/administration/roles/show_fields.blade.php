<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('roles.field_id')) !!}
    <p>{!! $role->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('roles.field_name')) !!}
    <p>{!! $role->name !!}</p>
</div>

<!-- Guard Name Field -->
<div class="form-group">
    {!! Form::label('guard_name', __('roles.field_guard_name')) !!}
    <p>{!! $role->guard_name !!}</p>
</div>
<!-- Permissions Field -->
<div class="form-group">
    {!! Form::label('permissions', __('roles.field_permissions')) !!}
    @foreach($role->permissions as $permission)
        <a class="btn btn-success btn-xs" href="{!! route('administration.permissions.show',$permission->id) !!}">{{ $permission->name  }}</a>
    @endforeach
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('created_at')) !!}
    <p>{!! $role->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('updated_at')) !!}
    <p>{!! $role->updated_at !!}</p>
</div>

