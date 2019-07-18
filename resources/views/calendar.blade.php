@extends('layouts.body')
@section('body')
    <div class="box box-body no-border">
        <div class="content">
            <div class="box box-info">
                <div class="box-body">
                    <div id="calendar" class="auto-jsCalendar material-theme">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            moment.locale('es');

            var events = [
                @if(isset($patientAppointments))
                    @foreach($patientAppointments as $appointment)
                        {
                            start: moment('{{ $appointment->date.' '.$appointment->time_start }}').format('X'),
                            end:  moment('{{ $appointment->date.' '.$appointment->time_end }}').format('X'),
                            title: 'Doctor: {{ $appointment->doctor->user->name }}',
                            content: '{{ $appointment->comments }}',
                            category: 'Citas medicas',
                        },
                    @endforeach
                @endif
                @if(isset($doctorAppointments))
                    @foreach($doctorAppointments as $appointment)
                    {
                        start: moment('{{ $appointment->date.' '.$appointment->time_start }}').format('X'),
                        end: moment('{{ $appointment->date.' '.$appointment->time_end }}').format('X'),
                        title: 'Paciente: {{ $appointment->patient->user->name }}',
                        content: '{{ $appointment->comments }}',
                        category: 'Consultas medicas'
                    },
                    @endforeach
                @endif
            ];

            /**
             * A daynote
             */
            // var daynotes = [
            //     {
            //         time: now.startOf('week').add(15, 'h').add(30, 'm').format('X'),
            //         title: 'Leo\'s holiday',
            //         content: 'yo',
            //         category: 'holiday'
            //     }
            // ];

            var calendar = $('#calendar').Calendar({
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
                    largeScreen: 'month',
                    smallScreenThreshold: 1000
                },
                colors: {
                    events: ['#2E7D32','#00838F'],
                    random: false
                },
                //daynotes: daynotes
            }).init();

            /**
             * Listening for events
             */

            // $('#calendar').on('Calendar.init', function(event, instance, before, current, after){
            //     console.log('event : Calendar.init');
            //     console.log(instance);
            //     console.log(before);
            //     console.log(current);
            //     console.log(after);
            // });
            // $('#calendar').on('Calendar.daynote-mouseenter', function(event, instance, elem){
            //     console.log('event : Calendar.daynote-mouseenter');
            //     console.log(instance);
            //     console.log(elem);
            // });
            // $('#calendar').on('Calendar.daynote-mouseleave', function(event, instance, elem){
            //     console.log('event : Calendar.daynote-mouseleave');
            //     console.log(instance);
            //     console.log(elem);
            // });
            // $('#calendar').on('Calendar.event-mouseenter', function(event, instance, elem){
            //     console.log('event : Calendar.event-mouseenter');
            //     console.log(instance);
            //     console.log(elem);
            // });
            // $('#calendar').on('Calendar.event-mouseleave', function(event, instance, elem){
            //     console.log('event : Calendar.event-mouseleave');
            //     console.log(instance);
            //     console.log(elem);
            // });
            // $('#calendar').on('Calendar.daynote-click', function(event, instance, elem, evt){
            //     console.log('event : Calendar.daynote-click');
            //     console.log(instance);
            //     console.log(elem);
            //     console.log(evt);
            // });
            // $('#calendar').on('Calendar.event-click', function(event, instance, elem, evt){
            //     console.log('event : Calendar.event-click');
            //     console.log(instance);
            //     console.log(elem);
            //     console.log(evt);
            // });
        });
        //https://www.jqueryscript.net/time-clock/Mobile-Friendly-Calendar-Schedule-Plugin.html
    </script>
@endsection
