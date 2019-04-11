@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Analises</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('laboratory.analises.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('laboratory.analises.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
    <script>
        console.log('yaya');
        @isset($saved)
            console.log('juan');
            @if($saved == true)
            console.log('lolo');
                if (confirm("Los analisis se agregaron correctamente y estaran listos dentro de 4 dias, desea agendar una cita ahora?")) {
                    location.href = '{{ route('doctor.schedulePatient') }}';
                }
                else {
                }
            @endif
        @endisset
    </script>
@endsection
