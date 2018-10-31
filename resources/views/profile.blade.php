@include('components.macros_icheck')
@extends('layouts.app')
@section('content')
    <div class="nav-tabs-custom content">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#profile" data-toggle="tab" aria-expanded="true">{{ __('profile') }}</a>
            </li>
            <li>
                <a href="#doctors" data-toggle="tab" aria-expanded="true">{{ __('doctors') }}</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="profile">
                <div class="">
                    <h1>{{ __('profile.edit_profile') }}</h1>
                    <hr>
                    {!! Form::model($model, ['route' => ['profile.update', Auth::user()->id], 'method' => 'patch',  'enctype' => 'multipart/form-data', 'class' => 'box box-info']) !!}
                        <div class="row box-body">
                        <!-- left column -->
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="{{ $avatarUrl }}" class="img-circle" style="width: 200px; height: 200px" alt="avatar">
                                <h6>{{ __('profile.message_select_different_photo') }}</h6>

                                <input id="image" type="file" name="image" class="form-control" accept="image/*">
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

                            <div class="form-horizontal" role="form">
                                <div class="form-group">
                                        {!! Form::label('name', __('profile.field_name'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('last_name', __('profile.field_last_name'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('birthdate', __('profile.field_birthdate'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        {!! Form::text('birthdate', null, ['class' => 'form-control date']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('gender', __('profile.field_gender'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        {!! Form::iRadio('gender',__('male'),1) !!}
                                        {!! Form::iRadio('gender',__('female'),0) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('email', __('profile.field_email'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('city', __('profile.field_city'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        {!! Form::text('city', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('address', __('profile.field_address'),['class' => 'col-lg-3 control-label']) !!}
                                    <div class="col-lg-8">
                                        {!! Form::text('address', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-8">
                                        {!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
                                        <span></span>
                                        <a href="{!! route('home') !!}" class="btn btn-default">{{ __('cancel') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="tab-pane" id="doctors">
                @include('sections.profile_doctors')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
