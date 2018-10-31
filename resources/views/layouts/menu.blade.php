<li class="{{ Request::is('patients*') ? 'active' : '' }}">
    <a href="{!! route('patients.index') !!}"><i class="fa fa-user"></i><span>Patients</span></a>
</li>
<li class="{{ Request::is('calendar*') ? 'active' : '' }}">
    <a href="{!! route('calendar.index') !!}"><i class="fa fa-calendar-alt"></i><span>Calendar</span></a>
</li>
<li class="treeview active">
    <a href="#"><i class="fa fa-user-md"></i> <span>{{ __('medical') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('medicalAppointments*') ? 'active' : '' }}">
            <a href="{!! route('medical.medicalAppointments.index') !!}"><i class="fa fa-calendar-alt"></i><span>{{ __('medical_appointments.title_medical_appointments') }}</span></a>
        </li>

        <li class="{{ Request::is('patients*') ? 'active' : '' }}">
            <a href="{!! route('medical.patients.index') !!}"><i class="fa fa-user"></i><span>Patients</span></a>
        </li>

        <li class="{{ Request::is('doctors*') ? 'active' : '' }}">
            <a href="{!! route('medical.doctors.index') !!}"><i class="fa fa-user-md"></i><span>{{ __('doctors.title_doctors') }}</span></a>
        </li>

        <li class="{{ Request::is('medicalAppointmentStates*') ? 'active' : '' }}">
            <a href="{!! route('medical.medicalAppointmentStates.index') !!}"><i class="fa fa-check-double"></i><span>{{ __('medical_appointment_states.title_medical_appointment_states') }}</span></a>
        </li>

        <li class="{{ Request::is('medicalConsultants*') ? 'active' : '' }}">
            <a href="{!! route('medical.medicalConsultants.index') !!}"><i class="fa fa-hospital"></i><span>{{ __('medical_consultants.title_medical_consultants') }}</span></a>
        </li>

        <li class="{{ Request::is('medicalSpecialties*') ? 'active' : '' }}">
            <a href="{!! route('medical.medicalSpecialties.index') !!}"><i class="fa fa-stethoscope"></i><span>{{ __('medical_specialties.title_medical_specialties') }}</span></a>
        </li>
    </ul>
</li>
<li class="treeview active">
    <a href="#"><i class="fa fa-users"></i> <span>{{ __('user_control') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
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
