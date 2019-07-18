<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('users.field_id')) !!}
    <p>{!! $user->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('users.field_name')) !!}
    <p>{!! $user->name !!}</p>
</div>

<!-- Last Name Field -->
<div class="form-group">
    {!! Form::label('last_name', __('users.field_last_name')) !!}
    <p>{!! $user->last_name !!}</p>
</div>

<!-- Birthdate Field -->
<div class="form-group">
    {!! Form::label('birthdate', __('users.field_birthdate')) !!}
    <p>{!! $user->birthdate !!}</p>
</div>

<!-- Gender Field -->
<div class="form-group">
    {!! Form::label('gender', __('users.field_gender')) !!}
    <p>{!! ($user->gender)?__('male'):__('females') !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('users.field_email')) !!}
    <p>{!! $user->email !!}</p>
</div>

<!-- Email Verified At Field -->
<div class="form-group">
    {!! Form::label('email_verified_at', __('users.field_email_verified_at')) !!}
    <p>{!! $user->email_verified_at !!}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', __('users.field_password')) !!}
    <p>{!! $user->password !!}</p>
</div>


<!-- Roles Field -->
<div class="form-group">
    {!! Form::label('roles', __('users.field_roles')) !!}
    @foreach($user->roles as $role)
        <a class="btn btn-info btn-xs" href="{!! route('administration.roles.show',$role->id) !!}">{{ $role->name  }}</a>
    @endforeach
</div>
<!-- Permissions Field -->
<div class="form-group">
    {!! Form::label('permissions', __('users.field_permissions')) !!}
    @foreach($user->permissions as $permission)
        <a class="btn btn-success btn-xs" href="{!! route('administration.permissions.show',$permission->id) !!}">{{ $permission->name  }}</a>
    @endforeach
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('created_at')) !!}
    <p>{!! $user->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('updated_at')) !!}
    <p>{!! $user->updated_at !!}</p>
</div>

