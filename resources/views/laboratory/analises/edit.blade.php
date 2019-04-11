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
                   {!! Form::model($analisis, ['route' => ['laboratory.analises.update', $analisis->id], 'method' => 'patch']) !!}

                        @include('laboratory.analises.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection