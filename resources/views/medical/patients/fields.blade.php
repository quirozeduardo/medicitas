<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('patients.field_user')) !!}
    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2']) !!}
</div>

<!-- Observations Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observations', __('patients.field_observations')) !!}
    {!! Form::text('observations', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('medical.patients.index') !!}" class="btn btn-default">{{ __('cancel') }}</a>
</div>
