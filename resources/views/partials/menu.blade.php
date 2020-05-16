<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
        @can('admin_profile')
        @if(Auth::User()->photo)
            <a href="{{ route('admin.profile') }}" >
            <img src="{{ Auth::User()->photo->getUrl('thumb') }}" class="nav-icon img-circle img-responsive center-block" id ="user-image" alt="Logo" style=" margin-top:10px; margin-bottom: 5px; border: 3px solid white;border-radius: 100%;width:50px; height:50px;">

            </a>
        @endif
            <li class="nav-item disabled" style="text-align:center">
            <a href="{{ route('admin.profile') }}" class="nav-link " id="username" >   
        @if(Auth::check())
            {{Auth::User()->name}}
        @endif
            </a>
            <hr style="color:white;">
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>

        @endcan

        @can('request_management')
        @if(Auth::User()->photo)
            <a href="{{ route('doctor.profile') }}" >
            <img src="{{ Auth::User()->photo->getUrl('thumb') }}" class="nav-icon img-circle img-responsive center-block" id ="user-image" alt="Logo" style=" margin-top:10px; margin-bottom: 5px; border: 3px solid white;border-radius: 100%;width:50px; height:50px;">

            </a>
        @endif
            <li class="nav-item disabled" style="text-align:center">
            <a href="{{ route('doctor.profile') }}" class="nav-link " id="username" >   
        @if(Auth::check())
            {{Auth::User()->name}}
        @endif
            </a>
            <hr style="color:white;">
            </li>
            <li class="nav-item">
                <a href="{{ route("doctor.dashboard") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>

        @endcan
        @can('patient_profile')
        @if(Auth::User()->photo)
            <a href="{{ route('patient.profile') }}" >
            <img src="{{ Auth::User()->photo->getUrl('thumb') }}" class="nav-icon img-circle img-responsive center-block" id ="user-image" alt="Logo" style=" margin-top:10px; margin-bottom: 5px; border: 3px solid white;border-radius: 100%;width:50px; height:50px;">

            </a>
        @endif
            <li class="nav-item disabled" style="text-align:center">
            <a href="{{ route('patient.profile') }}" class="nav-link " id="username" >   
        @if(Auth::check())
            {{Auth::User()->name}}
        @endif
            </a>
            <hr style="color:white;">
            </li>
            <li class="nav-item">
                <a href="{{ route("patient.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>

        @endcan


            @can('patient_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.patients.index") }}" class="nav-link {{ request()->is('admin/patients') || request()->is('admin/patients/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-wheelchair nav-icon">

                                    </i>
                                    Patients
                                </a>
                            </li>
                        @endcan
                        @can('appointment_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.appointments.index") }}" class="nav-link {{ request()->is('admin/appointments') || request()->is('admin/appointments/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-phone nav-icon">

                                    </i>
                                    Appointments
                                </a>
                            </li>
                        @endcan

                        @can('message_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.messages.index") }}" class="nav-link {{ request()->is('admin/messages') || request()->is('admin/messages/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-envelope nav-icon">

                                    </i>
                                    Messages
                                </a>
                            </li>
                        @endcan
                        @can('doctor_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-stethoscope nav-icon">

                        </i>
                        Doctor Management
                    </a>
                    <ul class="nav-dropdown-items">
                    @can('doctor_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.doctors.join_requests") }}" class="nav-link {{ request()->is('admin/doctors') || request()->is('admin/doctors/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-plus nav-icon">

                                    </i>
                                    View Join Requests
                                </a>
                            </li>
                        @endcan
                        @can('doctor_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.doctors.index") }}" class="nav-link {{ request()->is('admin/doctors') || request()->is('admin/doctors/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-heartbeat nav-icon">

                                    </i>
                                    Doctors List
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
                        @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                    
                        User Management
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('my_appointments')
            @can('request_management')

            <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-address-card nav-icon">

                        </i>
                        Manage Requests
                    </a>
                    <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{ route("doctor.appointments.requests") }}" class="nav-link {{ request()->is('doctor/appointments') || request()->is('doctor/appointments/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-phone nav-icon">

                                    </i>
                                    Appointments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("doctor.sessions.requests") }}" class="nav-link {{ request()->is('doctor/sessions') || request()->is('doctor/sessions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-handshake nav-icon">

                                    </i>
                                    Sessions Requests
                                </a>
                            </li>
                    </ul>
                </li>
            @endcan
                <li class="nav-item">
                            
                    <a href="{{ route("doctor.appointments.index") }}" class="nav-link {{ request()->is('admin/appointments') || request()->is('admin/appointments/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-phone nav-icon">
                        </i>
                        Appointments
                    </a>
                </li>
                <li class="nav-item">
                            
                    <a href="{{ route("doctor.patients.index") }}" class="nav-link {{ request()->is('admin/patients') || request()->is('admin/patients/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-wheelchair nav-icon">
                        </i>
                        Patients
                    </a>
                </li>
                @can('session_access')
                    <li class="nav-item">
                    <a href="{{ route("doctor.sessions.index") }}" class="nav-link {{ request()->is('admin/sessions') || request()->is('admin/sessions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-handshake nav-icon">

                        </i>
                        Sessions
                    </a>
                    </li>
                    @endcan            @can('payment_access')
                <li class="nav-item">
                    <a href="{{ route("doctor.payments.index") }}" class="nav-link {{ request()->is('admin/payments') || request()->is('admin/payments/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-money nav-icon">

                        </i>
                        Payment
                    </a>
                </li>

            @endcan
            <li class="nav-item">
                                <a href="{{ route("doctor.exercises.index") }}" class="nav-link {{ request()->is('doctor/exercises') || request()->is('doctor/exercises/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-handshake nav-icon">

                                    </i>
                                    Exercises 
                                </a>
                            </li>

            <li class="nav-item">
                                <a href="{{ route("doctor.systemCalendar") }}" class="nav-link {{ request()->is('admin/calendar') || request()->is('admin/calendar/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-calendar nav-icon">

                                    </i>
                                    Calendar
                                </a>
                            </li>
                        @endcan
                        @can('patient_appointments')

<li class="nav-item nav-dropdown">
        <a class="nav-link  nav-dropdown-toggle" href="#">
            <i class="fa-fw fas fa-address-card nav-icon">

            </i>
            My Appointments
        </a>
        <ul class="nav-dropdown-items">
        <li class="nav-item">
                            
                            <a href="{{ route("patient.appointments.index") }}" class="nav-link {{ request()->is('patient/appointments') || request()->is('patient/appointments/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-phone nav-icon">
                                </i>
                                Booked
                            </a>
                        </li>
                        <li class="nav-item">
                            
                            <a href="{{ route("patient.appointments.requests") }}" class="nav-link {{ request()->is('patient/appointments') || request()->is('patient/appointments/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-clock-o nav-icon">
                                </i>
                                Pending 
                            </a>
                        </li>
        </ul>
    </li>

                        @endcan
                            @can('patient_sessions')
                            <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-video-camera nav-icon">

                        </i>
                        My Sessions
                    </a>
                    <ul class="nav-dropdown-items">
                    <li class="nav-item">
                    <a href="{{ route("patient.sessions.index") }}" class="nav-link {{ request()->is('patient/sessions') || request()->is('patient/sessions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-handshake nav-icon">

                        </i>
                        Booked
                    </a>
                    </li>
                            <li class="nav-item">
                                <a href="{{ route("patient.sessions.requests") }}" class="nav-link {{ request()->is('doctor/sessions') || request()->is('doctor/sessions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-clock-o nav-icon">

                                    </i>
                                    Pending
                                </a>
                            </li>
                            <li class="nav-item">
                    <a href="{{ route('patient.patients.show',Auth::User()->patient->id) }}" class="nav-link {{ request()->is('patient/sessions') || request()->is('patient/sessions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-medkit nav-icon">

                        </i>
                        Treatment
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="{{ route("patient.exercises.index") }}" class="nav-link {{ request()->is('patient/exercises') || request()->is('patient/exercises/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-gamepad nav-icon">

                        </i>
                        Exercises
                    </a>
                    </li>

                    </ul>
                </li>
                 @can('patient_doctors')

                        <li class="nav-item">
                                <a href="{{ route("patient.doctors.index") }}" class="nav-link {{ request()->is('patient/doctors') || request()->is('patient/doctors/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-stethoscope nav-icon">

                                    </i>
                                    Doctors
                                </a>
                            </li>
                            @endcan

                    <li class="nav-item">
                    <a href="{{ route("patient.payments.index") }}" class="nav-link {{ request()->is('patient/payments') || request()->is('patient/payments/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-money nav-icon">

                        </i>
                        Payments
                    </a>
                </li>

                    @endcan
                            @can('patient_doctors')

                            <li class="nav-item">
                                <a href="{{ route("patient.systemCalendar") }}" class="nav-link {{ request()->is('patient/calendar') || request()->is('patient/calendar/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-calendar nav-icon">

                                    </i>
                                    Calendar
                                </a>
                            </li>

                        @endcan
        
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    Logout
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>