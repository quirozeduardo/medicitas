<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $analisis->id !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $analisis->status !!}</p>
</div>

<!-- Patient Id Field -->
<div class="form-group">
    {!! Form::label('patient_id', 'Patient Id:') !!}
    <p>{!! $analisis->patient_id !!}</p>
</div>

<!-- Arrived Analysis Date Field -->
<div class="form-group">
    {!! Form::label('arrived_analysis_date', 'Arrived Analysis Date:') !!}
    <p>{!! $analisis->arrived_analysis_date !!}</p>
</div>

<!-- Type Analisis Id Field -->
<div class="form-group">
    {!! Form::label('type_analisis_id', 'Type Analisis Id:') !!}
    <p>{!! $analisis->type_analisis_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $analisis->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $analisis->updated_at !!}</p>
</div>

