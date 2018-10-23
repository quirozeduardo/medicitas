<li class="treeview active">
    <a href="#"><i class="fa fa-users"></i> <span>{{ __('users.title_users') }}, {{ __('roles.title_roles') }}, {{ __('permissions.title_permissions') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{!! route('administration.users.index') !!}"><i class="fa fa-user"></i><span>{{ __('users.title_users') }}</span></a>
        </li>
        <li class="{{ Request::is('roles*') ? 'active' : '' }}">
            <a href="{!! route('administration.roles.index') !!}"><i class="fa fa-users"></i><span>{{ __('roles.title_roles') }}</span></a>
        </li>
        <li class="{{ Request::is('permissions*') ? 'active' : '' }}">
            <a href="{!! route('administration.permissions.index') !!}"><i class="fa fa-key"></i><span>{{ __('permissions.title_permissions') }}</span></a>
        </li>
    </ul>
</li>
