@extends('layouts.app')
@section('css')
    <style>
        .content-wrapper{
            background: url('{{ asset('images/bg_login.jpg') }}');
        }
    </style>
@endsection
@section('content')
    <div class="row content">
        <div class="col-sm-4"></div>
        <!-- /.login-logo -->
        <div class="col-sm-4 login-box-body">
            <p class="login-box-msg">INICIAR SESION</p>

            <form method="post" action="{{ url('/login') }}">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                    @endif

                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Recordar
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{ url('/password/reset') }}">Olvide mi contraseña</a><br>
            <a href="{{ url('/register') }}" class="text-center">Registrar un nuevo usuario</a>

        </div>
        <div class="col-sm-4"></div>
    </div>
@endsection
