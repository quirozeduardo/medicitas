<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('medical_appointments.field_id')) !!}
    <p>{!! $medicalAppointment->id !!}</p>
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', __('medical_appointments.field_date')) !!}
    <p>{!! $medicalAppointment->date !!}</p>
</div>
<!-- Time Start Field -->
<div class="form-group">
    {!! Form::label('time_start', __('medical_appointments.field_time_start')) !!}
    <p>{!! $medicalAppointment->time_start !!}</p>
</div>
<!-- Time End Field -->
<div class="form-group">
    {!! Form::label('time_end', __('medical_appointments.field_time_end')) !!}
    <p>{!! $medicalAppointment->time_end !!}</p>
</div>

<!-- Patient Id Field -->
<div class="form-group">
    {!! Form::label('patient_id', __('medical_appointments.field_patient')) !!}
    <p>{!! $medicalAppointment->patient->user->name !!}</p>
</div>

<!-- Doctor Id Field -->
<div class="form-group">
    {!! Form::label('doctor_id', __('medical_appointments.field_doctor')) !!}
    <p>{!! $medicalAppointment->doctor->user->name !!}</p>
</div>

<!-- Medical Consultant Id Field -->
<div class="form-group">
    {!! Form::label('medical_consultant_id', __('medical_appointments.field_medical_consultant')) !!}
    <p>{!! $medicalAppointment->medicalConsultant->name !!}</p>
</div>

<!-- Medical Appointment Status Id Field -->
<div class="form-group">
    {!! Form::label('medical_appointment_status_id', __('medical_appointments.field_medical_appointment_status')) !!}
    <p>{!! $medicalAppointment->medicalAppointmentStatus->name !!}</p>
</div>

<!-- Comments Field -->
<div class="form-group">
    {!! Form::label('comments', __('medical_appointments.field_comments')) !!}
    <p>{!! $medicalAppointment->comments !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('created_at')) !!}
    <p>{!! $medicalAppointment->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('update_at')) !!}
    <p>{!! $medicalAppointment->updated_at !!}</p>
</div>

