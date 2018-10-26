<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('medical_appointment_states.field_id')) !!}
    <p>{!! $medicalAppointmentState->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('medical_appointment_states.field_name')) !!}
    <p>{!! $medicalAppointmentState->name !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('medical_appointment_states.field_description')) !!}
    <p>{!! $medicalAppointmentState->description !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('created_at')) !!}
    <p>{!! $medicalAppointmentState->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('updated_at')) !!}
    <p>{!! $medicalAppointmentState->updated_at !!}</p>
</div>

