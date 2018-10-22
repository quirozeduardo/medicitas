@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('users.title_user') }}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($user, ['route' => ['administration.users.update', $user->id], 'method' => 'patch']) !!}

                        @include('administration.users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
