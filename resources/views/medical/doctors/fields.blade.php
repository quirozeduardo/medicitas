<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('doctors.field_id')) !!}
    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2']) !!}
</div>


<!-- Medical Speciality Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medical_speciality_id', __('doctors.field_medical_speciality')) !!}
    {!! Form::select('medical_speciality_id', $medicalSpecialties, old('medical_speciality_id'), ['class' => 'form-control select2']) !!}
</div>

<!-- Medical Consultant Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medical_consultant_id', __('doctors.field_medical_consultant')) !!}
    {!! Form::select('medical_consultant_id', $medicalConsultants, old('medical_consultant_id'), ['class' => 'form-control select2-nullable']) !!}
</div>

<!-- Permissions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('patients', __('doctors.field_patients')) !!}
    {!! Form::select('patients[]', $patients, old('patients'), ['class' => 'form-control select2','multiple'=>'multiple']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('medical.doctors.index') !!}" class="btn btn-default">{{ __('cancel') }}</a>
</div>
