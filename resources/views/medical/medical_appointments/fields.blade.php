<!-- Datetime Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', __('medical_appointments.field_date')) !!}
    {!! Form::text('date' ,null,['class' => 'form-control date', 'autocomplete' => 'off']) !!}
</div>

<!-- Time Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time_start', __('medical_appointments.field_time_start')) !!}
    {!! Form::text('time_start' ,null,['class' => 'form-control time']) !!}
</div>

<!-- Time Ens Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time_end', __('medical_appointments.field_time_end')) !!}
    {!! Form::text('time_end' ,null,['class' => 'form-control time']) !!}
</div>

<!-- Patient Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('patient_id', __('medical_appointments.field_patient')) !!}
    {!! Form::select('patient_id', $patients, old('patient_id'), ['class' => 'form-control select2']) !!}
</div>

<!-- Doctor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('doctor_id', __('medical_appointments.field_doctor')) !!}
    {!! Form::select('doctor_id', $doctors, old('doctor_id'), ['class' => 'form-control select2']) !!}
</div>

<!-- Medical Consultant Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medical_consultant_id', __('medical_appointments.field_medical_consultant')) !!}
    {!! Form::select('medical_consultant_id', $medicalConsultants, old('medical_consultant_id'), ['class' => 'form-control select2']) !!}
</div>

<!-- Medical Appointment Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medical_appointment_status_id', __('medical_appointments.field_medical_appointment_status')) !!}
    {!! Form::select('medical_appointment_status_id', $medicalAppointmentStates, old('medical_appointment_status_id'), ['class' => 'form-control select2']) !!}
</div>

<!-- Comments Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comments', __('medical_appointments.field_comments')) !!}
    {!! Form::text('comments', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('medical.medicalAppointments.index') !!}" class="btn btn-default">{{ __('cancel') }}</a>
</div>
