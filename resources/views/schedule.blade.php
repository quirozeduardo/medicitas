@extends('layouts.body')
@section('body')
    <div class="box box-body no-border">
        <div class="content">
            <div class="box box-info">
                <div class="box-body">
                    {!! Form::open(['route' => ['schedule.store']]) !!}
                    <div class="form-horizontal" role="form">
                        <div class="form-group">
                            {!! Form::label('doctor_id', __('medical_appointments.field_doctor'),['class' => 'col-lg-3 control-label']) !!}
                            <div class="col-lg-8">
                                {!! Form::select('doctor_id', $doctors, old('doctor_id'), ['class' => 'form-control select2']) !!}
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
                        @if($doctors)
                            @if($doctors->count()>0)
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-8">
                                        {!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
                                        <span></span>
                                        <a href="{!! route('home') !!}" class="btn btn-default">{{ __('cancel') }}</a>
                                    </div>
                                </div>
                            @else
                                <h4 class="text-center">No Hay Doctores</h4>
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
            $('.time#time_start').timepicker({
                'minTime': '5:00',
                'maxTime': '23:30',
                'timeFormat': 'G:i'
            }).val('5:00');
            $('.time#time_end').timepicker({
                'minTime': '5:30',
                'maxTime': '23:30',
                'timeFormat': 'G:i',
                'showDuration': true,
            }).val('5:30');
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
        });
        function refreshCalendar() {
            var request = $.ajax({
                method: 'post',
                url: "{{url('/')}}"+'/ajax/schedule/appointmentsDoctor',
                data: {
                    doctor_id: $('#doctor_id').val(),
                    date: $('#date').val()
                }
            });
            request.done(function (response) {
                var result = JSON.parse(response);
                var timeT = "5:00:00";
                var timeTE = "23:30:00";
                for(var i = 0; i < result.length; i++)
                {
                    events.push({
                        start: moment(result[i].date +' '+ timeT).format('X'),
                        end:  moment(result[i].date +' '+ result[i].time_start).format('X'),
                        title: 'Disponible ',
                        content: 'Horiario disponible para agendar',
                        category: 'Disponible',
                    });
                    timeT = result[i].time_end;
                }

                events.push({
                    start: moment($('#date').val() +' '+ timeT).format('X'),
                    end:  moment($('#date').val() +' '+ timeTE).format('X'),
                    title: 'Disponible ',
                    content: 'Horiario disponible para agendar',
                    category: 'Disponible',
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
                    colors: {
                        events: ['#00838F'],
                        random: false
                    },
                });

                calendar.setTimestamp(moment($('#date').val()).format('X'))
                calendar.init();
                $('#calendar').on('Calendar.event-click', function(event, instance, elem, evt){
                    console.log('event : Calendar.event-click');
                    console.log(instance);
                    console.log(elem);
                    console.log(evt);
                });
            });
            function as(ev){

            }
        }
    </script>
@endsection
