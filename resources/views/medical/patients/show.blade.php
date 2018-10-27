@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('patients.title_patient') }}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('medical.patients.show_fields')
                    <a href="{!! route('medical.patients.index') !!}" class="btn btn-default">{{ __('back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
