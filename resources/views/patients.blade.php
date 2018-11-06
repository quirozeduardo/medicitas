@extends('layouts.app')
@section('content')
    <div class="nav-tabs-custom content">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#all-patients" data-toggle="tab" aria-expanded="true">Todos</a>
            </li>
            <li>
                <a href="#my-patients" data-toggle="tab" aria-expanded="true">Mis pacientes</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="all-patients">
                <h1>Usuarios</h1>
                @include('sections.patient_add_circle_list')
            </div>
            <div class="tab-pane" id="my-patients">
                <h1>Mis Pacientes</h1>
                @include('sections.profile_view_circle_list')
            </div>
        </div>
    </div>
@endsection
