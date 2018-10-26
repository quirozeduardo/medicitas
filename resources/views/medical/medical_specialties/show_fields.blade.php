<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('medical_specialties.field_id')) !!}
    <p>{!! $medicalSpeciality->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('medical_specialties.field_name')) !!}
    <p>{!! $medicalSpeciality->name !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('medical_specialties.field_description')) !!}
    <p>{!! $medicalSpeciality->description !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('created_at')) !!}
    <p>{!! $medicalSpeciality->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('updated_at')) !!}
    <p>{!! $medicalSpeciality->updated_at !!}</p>
</div>

