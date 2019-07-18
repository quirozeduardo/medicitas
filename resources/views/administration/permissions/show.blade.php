@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ __('permissions.title_permission') }}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('administration.permissions.show_fields')
                    <a href="{!! route('administration.permissions.index') !!}" class="btn btn-default">{{ __('back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
