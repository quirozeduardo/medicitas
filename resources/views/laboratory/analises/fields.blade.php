<!-- Patient Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('patient_id', 'Paciente:') !!}
    {!! Form::select('patient_id', $patients, old('patient_id'), ['class' => 'form-control select2']) !!}

</div>

<!-- Arrived Analysis Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('arrived_analysis_date', 'Fecha de entrega de analisis:') !!}
{{--    {!! Form::text('arrived_analysis_date', null, ['class' => 'form-control date', 'autocomplete' => 'off']) !!}--}}
    <b-datepicker name="arrived_analysis_date" :date-formatter="(date) => `${date.getFullYear()}-${(date.getMonth() + 1)}-${date.getDate()}`">

    </b-datepicker>
</div>

<!-- Type Analisis Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_analisis_id', 'Tipo de analisis:') !!}
    {!! Form::select('type_analisis_id', $typeAnalisis, old('type_analisis_id'), ['class' => 'form-control select2']) !!}

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
{{--    <b-button v-on:click="this.save()" type="is-info">Save</b-button>--}}
    <a href="{!! route('laboratory.analises.index') !!}" class="btn btn-default">Cancel</a>
</div>
