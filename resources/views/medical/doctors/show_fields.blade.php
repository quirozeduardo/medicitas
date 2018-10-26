<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('doctors.field_id')) !!}
    <p>{!! $doctor->id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('doctors.field_user')) !!}
    <p>{!! $doctor->user->name !!}</p>
</div>

<!-- Medical Speciality Id Field -->
<div class="form-group">
    {!! Form::label('medical_speciality_id', __('doctors.field_medical_speciality')) !!}
    <p>{!! $doctor->medicalSpeciality->name !!}</p>
</div>

<!-- Medical Consultant Id Field -->
<div class="form-group">
    {!! Form::label('medical_consultant_id', __('doctors.field_medical_consultant')) !!}
    <p>{!! ($doctor->medicalConsultant)?$doctor->medicalConsultant->name:'' !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('created_at')) !!}
    <p>{!! $doctor->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('updated_at')) !!}
    <p>{!! $doctor->updated_at !!}</p>
</div>

