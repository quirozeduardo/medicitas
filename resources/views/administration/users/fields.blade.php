<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('users.field_name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', __('users.field_last_name')) !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birthdate', __('users.field_birthdate')) !!}
    {!! Form::date('birthdate', null, ['class' => 'form-control']) !!}
</div>


<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('users.field_email')) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>


<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('users.field_password')) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Confirm Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', __('users.field_confirm_password')) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', __('users.field_gender')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('gender', false) !!}
        {!! Form::checkbox('gender', '1', null) !!} 1
    </label>
</div>

<!-- Roles Field -->
<div class="form-group col-sm-6">
    {!! Form::label('roles', __('users.field_roles')) !!}
    {!! Form::select('roles[]', $roles, old('roles'), ['class' => 'form-control select2','multiple'=>'multiple']) !!}
</div>

<!-- Permissions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permissions', __('users.field_permissions')) !!}
    {!! Form::select('permissions[]', $permissions, old('permissions'), ['class' => 'form-control select2','multiple'=>'multiple']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('administration.users.index') !!}" class="btn btn-default">{{ __('cancel') }}</a>
</div>
