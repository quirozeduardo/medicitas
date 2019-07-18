@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
           {{ __('medical_specialties.title_medical_speciality') }}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('medical.medical_specialties.show_fields')
                    <a href="{!! route('medical.medicalSpecialties.index') !!}" class="btn btn-default">{{ __('back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
