<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('patients.field_id')) !!}
    <p>{!! $patient->id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('patients.field_user')) !!}
    <p>{!! $patient->user->name !!}</p>
</div>

<!-- Observations Field -->
<div class="form-group">
    {!! Form::label('observations', __('patients.field_observations')) !!}
    <p>{!! $patient->observations !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('created_at')) !!}
    <p>{!! $patient->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('updated_at')) !!}
    <p>{!! $patient->updated_at !!}</p>
</div>

