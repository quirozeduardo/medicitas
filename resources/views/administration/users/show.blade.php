@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('users.title_user') }}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('administration.users.show_fields')
                    <a href="{!! route('administration.users.index') !!}" class="btn btn-default">{{ __('back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
