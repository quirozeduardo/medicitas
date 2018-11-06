@extends('layouts.app')
@section('content')
    <div class="box box-body no-border">
        <div class="content">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                    <div id="calendar" class="auto-jsCalendar material-theme">

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            moment.locale('es');
            var now = moment();

            /**
             * Many events
             */
            var events = [
                {
                    start: now.startOf('week').add(9, 'h').format('X'),
                    end: now.startOf('week').add(10, 'h').format('X'),
                    title: '1',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Professionnal'
                },
                {
                    start: now.startOf('week').add(10, 'h').format('X'),
                    end: now.startOf('week').add(11, 'h').format('X'),
                    title: '2',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Professionnal'
                },
                {
                    start: now.startOf('week').add(11, 'h').format('X'),
                    end: now.startOf('week').add(12, 'h').format('X'),
                    title: '3',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Personnal'
                },
                {
                    start: now.startOf('week').add(1, 'days').add(9, 'h').format('X'),
                    end: now.startOf('week').add(1, 'days').add(10, 'h').format('X'),
                    title: '4',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Personnal'
                },
                {
                    start: now.startOf('week').add(1, 'days').add(9, 'h').add(30, 'm').format('X'),
                    end: now.startOf('week').add(1, 'days').add(10, 'h').add(30, 'm').format('X'),
                    title: '5',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Arrobe'
                },
                {
                    start: now.startOf('week').add(1, 'days').add(11, 'h').format('X'),
                    end: now.startOf('week').add(1, 'days').add(12, 'h').format('X'),
                    title: '6',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Another category'
                },
                {
                    start: now.startOf('week').add(2, 'days').add(9, 'h').format('X'),
                    end: now.startOf('week').add(2, 'days').add(10, 'h').format('X'),
                    title: '7',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Personnal'
                },
                {
                    start: now.startOf('week').add(2, 'days').add(9, 'h').add(30, 'm').format('X'),
                    end: now.startOf('week').add(2, 'days').add(10, 'h').add(30, 'm').format('X'),
                    title: '8',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Professionnal'
                },
                {
                    start: now.startOf('week').add(2, 'days').add(10, 'h').format('X'),
                    end: now.startOf('week').add(2, 'days').add(11, 'h').format('X'),
                    title: '9',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Personnal'
                },
                {
                    start: now.startOf('week').add(3, 'days').add(9, 'h').format('X'),
                    end: now.startOf('week').add(3, 'days').add(10, 'h').format('X'),
                    title: '10',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Professionnal'
                },
                {
                    start: now.startOf('week').add(3, 'days').add(9, 'h').add(15, 'm').format('X'),
                    end: now.startOf('week').add(3, 'days').add(10, 'h').add(15, 'm').format('X'),
                    title: '11',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Personnal'
                },
                {
                    start: now.startOf('week').add(3, 'days').add(9, 'h').add(30, 'm').format('X'),
                    end: now.startOf('week').add(3, 'days').add(10, 'h').add(30, 'm').format('X'),
                    title: '12',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Anything else'
                },
                {
                    start: now.startOf('week').add(4, 'days').add(9, 'h').format('X'),
                    end: now.startOf('week').add(4, 'days').add(12, 'h').format('X'),
                    title: '13',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Private'
                },
                {
                    start: now.startOf('week').add(4, 'days').add(9, 'h').add(30, 'm').format('X'),
                    end: now.startOf('week').add(4, 'days').add(10, 'h').format('X'),
                    title: '14',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'No more creative category name'
                },
                {
                    start: now.startOf('week').add(4, 'days').add(11, 'h').format('X'),
                    end: now.startOf('week').add(4, 'days').add(11, 'h').add(30, 'm').format('X'),
                    title: '15',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Professionnal'
                },
                {
                    start: now.startOf('week').add(5, 'days').add(10, 'h').format('X'),
                    end: now.startOf('week').add(5, 'days').add(12, 'h').format('X'),
                    title: '17',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Private'
                },
                {
                    start: now.startOf('week').add(5, 'days').add(9, 'h').add(30, 'm').format('X'),
                    end: now.startOf('week').add(5, 'days').add(10, 'h').add(30, 'm').format('X'),
                    title: '16',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Course'
                },
                {
                    start: now.startOf('week').add(5, 'days').add(11, 'h').add(30, 'm').format('X'),
                    end: now.startOf('week').add(5, 'days').add(12, 'h').add(30, 'm').format('X'),
                    title: '18',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'No more creative category name'
                },
                {
                    start: now.startOf('week').add(5, 'days').add(12, 'h').format('X'),
                    end: now.startOf('week').add(5, 'days').add(13, 'h').format('X'),
                    title: '19',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Another one'
                },
                {
                    start: now.startOf('week').add(5, 'days').add(12, 'h').add(15, 'm').format('X'),
                    end: now.startOf('week').add(5, 'days').add(13, 'h').format('X'),
                    title: '21',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'One again'
                },
                {
                    start: now.startOf('week').add(5, 'days').add(12, 'h').add(45, 'm').format('X'),
                    end: now.startOf('week').add(5, 'days').add(13, 'h').add(45, 'm').format('X'),
                    title: '22',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Encore'
                },
                {
                    start: now.startOf('week').add(5, 'days').add(13, 'h').add(45, 'm').format('X'),
                    end: now.startOf('week').add(5, 'days').add(14, 'h').format('X'),
                    title: '23',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Professionnal'
                },
                {
                    start: now.startOf('week').add(5, 'days').add(12, 'h').format('X'),
                    end: now.startOf('week').add(5, 'days').add(14, 'h').add(30, 'm').format('X'),
                    title: '20',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Private'
                },
                {
                    start: now.startOf('week').add(5, 'days').add(13, 'h').add(45, 'm').format('X'),
                    end: now.startOf('week').add(5, 'days').add(15, 'h').format('X'),
                    title: '27',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Encore'
                },
                {
                    start: now.startOf('week').add(5, 'days').add(14, 'h').add(30, 'm').format('X'),
                    end: now.startOf('week').add(5, 'days').add(15, 'h').format('X'),
                    title: '28',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Private'
                },
                {
                    start: now.startOf('week').add(6, 'days').add(9, 'h').format('X'),
                    end: now.startOf('week').add(6, 'days').add(11, 'h').format('X'),
                    title: '24',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Foo'
                },
                {
                    start: now.startOf('week').add(6, 'days').add(9, 'h').format('X'),
                    end: now.startOf('week').add(6, 'days').add(11, 'h').format('X'),
                    title: '25',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Bar'
                },
                {
                    start: now.startOf('week').add(6, 'days').add(9, 'h').format('X'),
                    end: now.startOf('week').add(6, 'days').add(11, 'h').format('X'),
                    title: '26',
                    content: 'Hello World! <br> <p>Foo Bar</p>',
                    category:'Baz'
                },
            ];

            /**
             * A daynote
             */
            var daynotes = [
                {
                    time: now.startOf('week').add(15, 'h').add(30, 'm').format('X'),
                    title: 'Leo\'s holiday',
                    content: 'yo',
                    category: 'holiday'
                }
            ];

            /**
             * Init the calendar
             */
            var calendar = $('#calendar').Calendar({
                locale: 'en',
                weekday: {
                    timeline: {
                        intervalMinutes: 30,
                        fromHour: 9
                    }
                },
                events: events,
                //daynotes: daynotes
            }).init();

            /**
             * Listening for events
             */

            $('#calendar').on('Calendar.init', function(event, instance, before, current, after){
                console.log('event : Calendar.init');
                console.log(instance);
                console.log(before);
                console.log(current);
                console.log(after);
            });
            $('#calendar').on('Calendar.daynote-mouseenter', function(event, instance, elem){
                console.log('event : Calendar.daynote-mouseenter');
                console.log(instance);
                console.log(elem);
            });
            $('#calendar').on('Calendar.daynote-mouseleave', function(event, instance, elem){
                console.log('event : Calendar.daynote-mouseleave');
                console.log(instance);
                console.log(elem);
            });
            $('#calendar').on('Calendar.event-mouseenter', function(event, instance, elem){
                console.log('event : Calendar.event-mouseenter');
                console.log(instance);
                console.log(elem);
            });
            $('#calendar').on('Calendar.event-mouseleave', function(event, instance, elem){
                console.log('event : Calendar.event-mouseleave');
                console.log(instance);
                console.log(elem);
            });
            $('#calendar').on('Calendar.daynote-click', function(event, instance, elem, evt){
                console.log('event : Calendar.daynote-click');
                console.log(instance);
                console.log(elem);
                console.log(evt);
            });
            $('#calendar').on('Calendar.event-click', function(event, instance, elem, evt){
                console.log('event : Calendar.event-click');
                console.log(instance);
                console.log(elem);
                console.log(evt);
            });
        });
        //https://www.jqueryscript.net/time-clock/Mobile-Friendly-Calendar-Schedule-Plugin.html
    </script>
@endsection
