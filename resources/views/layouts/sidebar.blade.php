<aside class="main-sidebar" id="sidebar-wrapper">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $avatarUrl }}" class="img-circle"
                     alt="User Image"/>
            </div>
            <div class="pull-left mt-2 ml-2">
                @if (Auth::guest())
                <p>{{ __('guest') }}</p>
                @else
                    <a href="{{ route('profile.index') }}"><h5 class="text-bold">{{ Auth::user()->name}}</h5></a>
                @endif
            </div>
        </div>

        <!-- search form (Optional) -->
        {{--<form action="#" method="get" class="sidebar-form">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="q" class="form-control" placeholder="Search..."/>--}}
          {{--<span class="input-group-btn">--}}
            {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>--}}
            {{--</button>--}}
          {{--</span>--}}
            {{--</div>--}}
        {{--</form>--}}
        <!-- Sidebar Menu -->

        <ul class="sidebar-menu" data-widget="tree">
            @if (!Auth::guest())
            @include('layouts.menu')
            @endif
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
