@include('components.macros_icheck')
@extends('layouts.app')
@section('content')
    <div class="row content">

        <div class="col-sm-4"></div>
        <div class="col-sm-4 center-block register-box-body">
            <p class="login-box-msg">Register a new membership</p>

            <form method="post" action="{{ url('/register') }}">

                {!! csrf_field() !!}

                <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>

                    @if ($errors->has('name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>

                    @if ($errors->has('last_name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                    <input type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}" placeholder="Birthdate">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>

                    @if ($errors->has('birthdate'))
                        <span class="help-block">
                        <strong>{{ $errors->first('birthdate') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('gender') ? ' has-error' : '' }}">
                    {!! Form::iRadio('gender',__('male'),1) !!}
                    {!! Form::iRadio('gender',__('female'),0) !!}

                    @if ($errors->has('gender'))
                        <span class="help-block">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
        <div class="col-sm-4"></div>
    </div>
@endsection
