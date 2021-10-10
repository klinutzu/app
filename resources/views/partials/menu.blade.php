<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('proiecte_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/comenzis*") ? "c-show" : "" }} {{ request()->is("admin/surveyuris*") ? "c-show" : "" }} {{ request()->is("admin/instalaris*") ? "c-show" : "" }} {{ request()->is("admin/facturares*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-tasks c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.proiecte.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('comenzi_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.comenzis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/comenzis") || request()->is("admin/comenzis/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.comenzi.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('surveyuri_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.surveyuris.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/surveyuris") || request()->is("admin/surveyuris/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.surveyuri.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('instalari_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.instalaris.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/instalaris") || request()->is("admin/instalaris/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-people-carry c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.instalari.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('facturare_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.facturares.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/facturares") || request()->is("admin/facturares/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.facturare.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('monitorizare_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/detaliitehnices*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-broadcast-tower c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.monitorizare.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('detaliitehnice_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.detaliitehnices.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/detaliitehnices") || request()->is("admin/detaliitehnices/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.detaliitehnice.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('administrare_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/initiatoris*") ? "c-show" : "" }} {{ request()->is("admin/presales*") ? "c-show" : "" }} {{ request()->is("admin/serviciis*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.administrare.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('initiatori_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.initiatoris.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/initiatoris") || request()->is("admin/initiatoris/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-couch c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.initiatori.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('presale_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.presales.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/presales") || request()->is("admin/presales/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.presale.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('servicii_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.serviciis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/serviciis") || request()->is("admin/serviciis/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bezier-curve c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.servicii.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>