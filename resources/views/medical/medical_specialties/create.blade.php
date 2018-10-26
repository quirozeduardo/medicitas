@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('medical_specialties.title_medical_speciality') }}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'medical.medicalSpecialties.store']) !!}

                        @include('medical.medical_specialties.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
