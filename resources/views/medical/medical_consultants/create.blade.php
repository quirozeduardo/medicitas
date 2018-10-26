@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('medical_consultants.title_medical_consultant') }}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'medical.medicalConsultants.store']) !!}

                        @include('medical.medical_consultants.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
