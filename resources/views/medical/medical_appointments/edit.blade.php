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
                   {!! Form::model($medicalAppointment, ['route' => ['medical.medicalAppointments.update', $medicalAppointment->id], 'method' => 'patch']) !!}

                        @include('medical.medical_appointments.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
