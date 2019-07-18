@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('medical_appointments.title_medical_appointment') }}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'medical.medicalAppointments.store']) !!}

                        @include('medical.medical_appointments.fields')

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
