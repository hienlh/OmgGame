<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('admin.dashboard') }}" class="site_title">
                <span>{{ config('app.name') }}</span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ auth()->user()->getAvatarUrl() }}" alt="auth()->user()->name"
                     class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <h2>{{ auth()->user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>{{ __('views.backend.section.navigation.sub_header_0') }}</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            {{ __('views.backend.section.navigation.menu_0_1') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>{{ __('views.backend.section.navigation.sub_header_1') }}</h3>
                <ul class="nav side-menu">
                    @permission('games')
                    <li>
                        <a href="{{ route('admin.all-games.index') }}">
                            <i class="fa fa-gamepad" aria-hidden="true"></i>
                            {{ __('views.backend.section.navigation.all_games') }}
                        </a>
                    </li>
                    @endpermission
                    @permission('info_forms')
                    <li>
                        <a href="{{ route('admin.info_forms.index') }}">
                            <i class="fa fa-gamepad" aria-hidden="true"></i>
                            {{ __('views.admin.info_forms') }}
                        </a>
                    </li>
                    @endpermission
                    @permission('customer')
                    <li>
                        <a href="{{ route('admin.games.index') }}">
                            <i class="fa fa-gamepad" aria-hidden="true"></i>
                            {{ __('views.backend.section.navigation.games') }}
                        </a>
                    </li>
                    @endpermission
                </ul>
            </div>
            @permission(['roles','permissions','users'])
            <div class="menu_section">
                <h3>{{ __('views.backend.section.navigation.sub_header_2') }}</h3>
                <ul class="nav side-menu">
                    @permission('users')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            {{ __('views.backend.section.navigation.users') }}
                        </a>
                    </li>
                    @endpermission
                    @permission('roles')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            {{ __('views.backend.section.navigation.roles') }}
                        </a>
                    </li>
                    @endpermission
                    @permission('permissions')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            {{ __('views.backend.section.navigation.permissions') }}
                        </a>
                    </li>
                    @endpermission
                </ul>
            </div>
            @endpermission
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
