@extends('layouts.body')
@section('body')
    <div class="nav-tabs-custom content">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#my-patients" data-toggle="tab" aria-expanded="true">Mis pacientes</a>
            </li>
            <li>
                <a href="#all-patients" data-toggle="tab" aria-expanded="true">Todos</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="my-patients">
                <h1>Mis Pacientes</h1>
                @include('partials.profile_view_circle_list')
            </div>
            <div class="tab-pane" id="all-patients">
                <h1>Pacientes</h1>
                <div>
                    <div class="box box-info">
                        <div class="box-body">
                            <ul class="users-list clearfix">
                                @if(isset($patients))
                                    @foreach($patients as $patient)
                                        <li>
                                            <img class="user-profile-image" src="{{ \App\Http\Controllers\ProfileController::getAvatarUrlUser($patient->user) }}" alt="{{ $patient->user->name }}">
                                            <a class="users-list-name" href="{!! route('patients.addPatient',$patient->id) !!}">{{ $patient->user->name }}</a>
                                            <span class="users-list-date">
                                                <a href="{{ route('messenger.read',$patient->user->id)}}"><i class="fa fa-comments"></i> Mensaje</a>
                                                <br>
                                                @if(! ($doctorPatient = $patient->doctorPatient->first()))
                                                    <a href="{{ route('patients.addPatient',$patient->id)}}"><i class="fa fa-user-plus"></i> Agregar</a>
                                                @else
                                                    @if($send_by_patient = $doctorPatient->send_by_patient == true)
                                                        <a href="{{ route('patients.acceptPatient',$patient->id)}}"><i class="fa fa-user-plus"></i> Aceptar</a>
                                                        <br>
                                                        <a href="{{ route('patients.rejectPatient',$patient->id)}}"><i class="fa fa-user-times"></i> Rechazar</a>
                                                    @elseif($send_by_patient == false)
                                                        @if($doctorPatient->accepted === null)
                                                            Solicitud enviada
                                                        @elseif($doctorPatient->accepted == false)
                                                            <p class="text-danger">Solicitud Rechazada</p>
                                                        @endif
                                                    @endif
                                                @endif
                                            </span>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
