@extends('layouts.body')

@section('body')
<div class="content">
    <div class="row">
        <article class="col-sm-12">
            <div class="mensaje">
                <h2>Gestion de Citas Medicas</h2>
            </div>
            <p><i class="text-aqua fas fa-pills fa-10x"></i>
            </p><br/><br/>
            <p>Bienvenido a <b>{{ config('app.name') }}</b> un Sistema de Citas Medicas util para consultorios medicos y/o medicos independientes.</p>
            <br/><br/>
            <h3>Nuestras funciones</h3><br/>
            <p>	- Gestion de Citas <br/>
                - Gestion de Medicos <br/>
                - Gestion de Pacientes <br/>
                - Gestion de Consultorios <br/>
                - Gestion de Usuarios con Acceso al Sistema <br/>
            </p>
        </article>
    </div>
</div>
@endsection
