@extends('layouts.body')
@section('body')
    <div class="box box-body no-border">
        <div class="content">
            <div class="box box-info">
                <div class="box-body">
                    {!! Form::open(['route' => ['schedulePatient.store']]) !!}
                    <div class="form-horizontal" role="form">
                        <div class="form-group">
                            {!! Form::label('patient_id', __('medical_appointments.field_doctor'),['class' => 'col-lg-3 control-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::select('patient_id', $patients, old('patient_id'), ['class' => 'form-control select2']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('date', __('medical_appointments.field_date'),['class' => 'col-lg-3 control-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::text('date' ,null,['class' => 'form-control date', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                        <div id="calendar" class="auto-jsCalendar material-theme">

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
                        <!-- Submit Field -->
                        @if($patients)
                            @if($patients->count()>0)
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-8">
                                        {!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
                                        <span></span>
                                        <a href="{!! route('home') !!}" class="btn btn-default">{{ __('cancel') }}</a>
                                    </div>
                                </div>
                            @else
                                <h4 class="text-center">No Hay Pacientes</h4>
                            @endif
                        @endif
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script !src="">
        var calendar;
        var events = [
            {

            },
        ];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {


            $('#date').val(moment().format('YYYY-MM-DD'));
            refreshCalendar();
            $('#date').change(function(e){
                refreshCalendar();
            });
            setTime('5:30','23:30');
        });
        function setTime(ini,endi) {
            $('.time#time_start').timepicker({
                'minTime': ini,
                'maxTime': endi,
                'timeFormat': 'G:i'
            }).val(ini);
            $('.time#time_end').timepicker({
                'minTime': ini,
                'maxTime': endi,
                'timeFormat': 'G:i',
                'showDuration': true,
            }).val(endi);
            $('.time#time_start').on('changeTime', function() {
                var timeSelected = $(this).val();
                var timeEnd = $('.time#time_end');
                timeEnd.val(timeSelected);
                timeEnd.timepicker({
                    'minTime': timeSelected,
                    'maxTime': endi,
                    'timeFormat': 'G:i',
                    'showDuration': true,
                })
            });
        }
        function refreshCalendar() {
            var request = $.ajax({
                method: 'post',
                url: "{{url('/')}}"+'/ajax/schedulePatient/appointmentsPatient',
                data: {
                    patient_id: $('#patient_id').val(),
                    date: $('#date').val()
                }
            });
            request.done(function (response) {
                var result = JSON.parse(response);
                var timeT = "5:00:00";
                var timeTE = "23:30:00";
                for(var i = 0; i < result.length; i++)
                {
                    var ini = moment(result[i].date +' '+ timeT).format('X');
                    var endi = moment(result[i].date +' '+ result[i].time_start).format('X');
                    if((endi-ini) == 0)
                    {
                        continue;
                    }
                    events.push({
                        start: ini,
                        end:  endi,
                        title: 'Disponible ',
                        content: 'Horiario disponible para agendar',
                        category: 'Disponible '+i,
                    });
                    timeT = result[i].time_end;
                }

                events.push({
                    start: moment($('#date').val() +' '+ timeT).format('X'),
                    end:  moment($('#date').val() +' '+ timeTE).format('X'),
                    title: 'Disponible ',
                    content: 'Horiario disponible para agendar',
                    category: 'Disponible '+'x',
                });

                events.push();
                calendar = $('#calendar').Calendar({
                    locale: '{{ Config::get('app.locale') }}',
                    weekday: {
                        timeline: {
                            intervalMinutes: 60,
                            fromHour: 4,
                            toHour: 23
                        }
                    },
                    events: events,
                    defaultView: {
                        largeScreen: 'day',
                        smallScreenThreshold: 1000
                    },
                });

                calendar.setTimestamp(moment($('#date').val()).format('X'))
                calendar.init();
                $('#calendar').on('Calendar.event-click', function(event, instance, elem, evt){
                    setTime(moment.unix(evt.start).format("HH:MM"),moment.unix(evt.end).format("HH:MM"));
                });
            });
            function as(ev){

            }
        }
    </script>
@endsection
