@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('medical_appointment_states.title_medical_appointment_status') }}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'medical.medicalAppointmentStates.store']) !!}

                        @include('medical.medical_appointment_states.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
