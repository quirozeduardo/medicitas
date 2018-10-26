<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('permissions.field_id')) !!}
    <p>{!! $permission->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('permissions.field_name')) !!}
    <p>{!! $permission->name !!}</p>
</div>

<!-- Guard Name Field -->
<div class="form-group">
    {!! Form::label('guard_name', __('permissions.field_guard_name')) !!}
    <p>{!! $permission->guard_name !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('created_at')) !!}
    <p>{!! $permission->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('updated_at')) !!}
    <p>{!! $permission->updated_at !!}</p>
</div>

