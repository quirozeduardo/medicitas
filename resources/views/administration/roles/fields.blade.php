<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('roles.field_name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Permissions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permissions', __('roles.field_permissions')) !!}
    {!! Form::select('permissions[]', $permissions, old('permissions'), ['class' => 'form-control select2','multiple'=>'multiple']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('administration.roles.index') !!}" class="btn btn-default">{{ __('cancel') }}</a>
</div>
