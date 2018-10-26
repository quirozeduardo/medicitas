<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('medical_consultants.field_name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('medical_consultants.field_description')) !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('medical.medicalConsultants.index') !!}" class="btn btn-default">{{ __('cancel') }}</a>
</div>
