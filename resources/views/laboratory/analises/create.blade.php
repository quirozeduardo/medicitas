@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Analisis
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    <laboratory/>
                </div>
            </div>
        </div>
    </div>
@endsection
