@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('medical_appointments.title_medical_appointment') }}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('medical.medical_appointments.show_fields')
                    <a href="{!! route('medical.medicalAppointments.index') !!}" class="btn btn-default">{{ __('back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
