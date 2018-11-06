@extends('layouts.app')
@section('content')
    <div class="nav-tabs-custom content">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#schedule" data-toggle="tab" aria-expanded="true">{{ __('schedule') }}</a>
            </li>
            <li>
                <a href="#doctors" data-toggle="tab" aria-expanded="true">{{ __('doctors') }}</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="schedule">

            </div>
            <div class="tab-pane" id="doctors">
                @include('sections.profile_view_circle_list')
            </div>
        </div>
    </div>
@endsection
