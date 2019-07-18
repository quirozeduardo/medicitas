<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('medical_consultants.field_id')) !!}
    <p>{!! $medicalConsultant->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('medical_consultants.field_name')) !!}
    <p>{!! $medicalConsultant->name !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('medical_consultants.field_description')) !!}
    <p>{!! $medicalConsultant->description !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('created_at')) !!}
    <p>{!! $medicalConsultant->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('updated_at')) !!}
    <p>{!! $medicalConsultant->updated_at !!}</p>
</div>

