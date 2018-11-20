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
                @include('partials.profile_view_circle_list')
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
                                            <a class="users-list-name" href="{!! route('doctors.addDoctor',$doctor->id) !!}">{{ $doctor->user->name }}</a>
                                            <span class="users-list-date">
                                                <a href="{{ route('messenger.read',$doctor->user->id)}}"><i class="fa fa-comments"></i> Mensaje</a>
                                                <br>
                                                <a href="{{ route('doctors.addDoctor',$doctor->id)}}"><i class="fa fa-user-plus"></i> Agregar</a>
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