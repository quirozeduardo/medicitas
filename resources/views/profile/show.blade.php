@include('components.macros_icheck')
@extends('layouts.body')
@section('body')
    <div class="nav-tabs-custom content">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#profile" data-toggle="tab" aria-expanded="true">{{ __('profile') }}</a>
            </li>
            <li>
                <a href="#algo" data-toggle="tab" aria-expanded="true">Algo mas</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="profile">
                <div class="">
                    <h1>Ver Perfil</h1>
                    <hr>
                    <div class="row box-body">
                        <!-- left column -->
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="{{ $avatarUrl }}" class="img-circle" style="width: 200px; height: 200px" alt="avatar">
                            </div>
                        </div>

                        <!-- edit form column -->
                        <div class="col-md-9 personal-info">
                            {{--<div class="alert alert-info alert-dismissable">--}}
                            {{--<a class="panel-close close" data-dismiss="alert">×</a>--}}
                            {{--<i class="fa fa-coffee"></i>--}}
                            {{--This is an <strong>.alert</strong>. Use this to show important messages to the user.--}}
                            {{--</div>--}}
                            {{--<h3>Personal info</h3>--}}

                            <div class="form-horizontal">
                                <div class="form-group">
                                    {!! Form::label('name', __('profile.field_name'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        <p>{!! $model['name'] !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('last_name', __('profile.field_last_name'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        <p>{!! $model['last_name'] !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('birthdate', __('profile.field_birthdate'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        <p>{!! $model['birthdate'] !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('gender', __('profile.field_gender'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        <p>{!! ($model['gender'])?__('male'):__('female') !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('email', __('profile.field_email'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        <p>{!! $model['email'] !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('city', __('profile.field_city'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        <p>{!! $model['city'] !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('address', __('profile.field_address'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        <p>{!! $model['address'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="algo">
            </div>
        </div>
    </div>
@endsection
