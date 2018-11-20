@extends('layouts.body')
@section('body')
    <div class="box box-body no-border">
        <div class="content">
            <div class="box box-info">
                <div class="box-body">
                    {!! Form::open(['route' => ['schedule.store']]) !!}
                    <div class="form-horizontal" role="form">
                        <div class="form-group">
                            {!! Form::label('date', __('medical_appointments.field_date'),['class' => 'col-lg-3 control-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('date' ,null,['class' => 'form-control date', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('time_start', __('medical_appointments.field_time_start'),['class' => 'col-lg-3 control-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('time_start' ,null,['class' => 'form-control time']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('time_end', __('medical_appointments.field_time_end'),['class' => 'col-lg-3 control-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('time_end' ,null,['class' => 'form-control time']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('doctor_id', __('medical_appointments.field_doctor'),['class' => 'col-lg-3 control-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::select('doctor_id', $doctors, old('doctor_id'), ['class' => 'form-control select2']) !!}
                            </div>
                        </div>
                        <!-- Submit Field -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                {!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
                                <span></span>
                                <a href="{!! route('home') !!}" class="btn btn-default">{{ __('cancel') }}</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script !src="">
        $('.time#time_start').timepicker({
            'minTime': '5:00',
            'maxTime': '23:30',
            'timeFormat': 'G:i'
        }).val('5:00');
        $('.time#time_end').timepicker({
            'minTime': '5:00',
            'maxTime': '23:30',
            'timeFormat': 'G:i',
            'showDuration': true,
        }).val('5:00');
        $('.time#time_start').on('changeTime', function() {
            var timeSelected = $(this).val();
            var timeEnd = $('.time#time_end');
            timeEnd.val(timeSelected);
            timeEnd.timepicker({
                'minTime': timeSelected,
                'maxTime': '23:30',
                'timeFormat': 'G:i',
                'showDuration': true,
            })
        });
    </script>
@endsection
