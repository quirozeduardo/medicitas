@extends('layouts.body')
@section('body')
    <div class="nav-tabs-custom content">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#my-patients" data-toggle="tab" aria-expanded="true">Mis Doctores</a>
            </li>
            <li>
                <a href="#all-patients" data-toggle="tab" aria-expanded="true">Todos</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="my-patients">
                <h1>Mis Doctores</h1>
                @include('partials.profile_view_circle_list_doctors')
            </div>
            <div class="tab-pane" id="all-patients">
                <h1>Doctores</h1>
                <div>
                    <div class="box box-info">
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">
                                @if(isset($doctors))
                                    @foreach($doctors as $doctor)
                                        <li>
                                            <img class="user-profile-image" src="{{ \App\Http\Controllers\ProfileController::getAvatarUrlUser($doctor->user) }}" alt="{{ $doctor->user->name }}">
                                            <a class="users-list-name" href="{!! route('profile.show',$doctor->id) !!}">{{ $doctor->user->name }}</a>
                                                @php
                                                    $ratingTotal = \App\Rating::where('doctor_id', $doctor->id)->sum('rating');
                                                    $ratingCount = \App\Rating::where('doctor_id', $doctor->id)->get()->count();
                                                    $p = 5;
                                                    if (intval($ratingCount) > 0) {
                                                        $p = intval(intval($ratingTotal) / intval($ratingCount));
                                                    }
                                                @endphp
                                                <div>
                                                    <stars :ratingable="'false'" :doctor="'{{ $doctor->id }}'" :rating="'{{ $p }}'"></stars>
                                                </div>
                                            <a href=""><h4>{{ $doctor->medicalSpeciality->name }}</h4></a>
                                            <span class="users-list-date">
                                                <a href="{{ route('messenger.read',$doctor->user->id)}}"><i class="fa fa-comments"></i> Mensaje</a>
                                                <br>
                                                @if($doctorPatient = $doctor->doctorPatient->where('patient_id', \App\Models\Medical\Patient::where('user_id',Auth::user()->id)->first()->id)->first())
                                                    @if($doctorPatient->send_by == Auth::user()->id)
                                                        @if(intval($doctorPatient->accepted) == 0)
                                                            Solicitud enviada
                                                        @elseif(intval($doctorPatient->accepted) == 2)
                                                            <p class="text-danger">Solicitud Rechazada</p>
                                                        @endif
                                                    @else
                                                        @if(intval($doctorPatient->accepted) == 0)
                                                            <a href="{{ route('doctors.acceptDoctor',$doctor->id)}}"><i class="fa fa-user-plus"></i> Aceptar</a>
                                                            <br>
                                                            <a href="{{ route('doctors.rejectDoctor',$doctor->id)}}"><i class="fa fa-user-times"></i> Rechazar</a>
                                                        @elseif(intval($doctorPatient->accepted) == 2)
                                                            <a class="text-danger" href="{{ route('doctors.rejectDoctor',$doctor->id)}}"><i class="fa fa-user-plus"></i> Aceptar</a>
                                                        @endif
                                                    @endif
                                                @else
                                                    <a href="{{ route('doctors.addDoctor',$doctor->id)}}"><i class="fa fa-user-plus"></i> Agregar</a>
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
