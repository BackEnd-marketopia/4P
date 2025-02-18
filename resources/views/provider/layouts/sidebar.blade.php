<div class="sidebar" data-background-color="white">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="white">
            <a href="{{ route('provider.index') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/app_logo.png') }}" alt="4P" class="navbar-brand" height="50" />
                <p>4P</p>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ Route::currentRouteName() == 'provider.index' ? 'active' : '' }}">
                    <a href="{{ route('provider.index') }}">
                        <i class="fas fa-home"></i>
                        <p>{{ __('message.Home') }}</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'provider.profile' ? 'active' : '' }}">
                    <a href="{{ route('provider.profile') }}">
                        <i class="fas fa-user-tie"></i>
                        <p>{{ __('message.My Profile') }}</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ Route::currentRouteName() == 'provider.class-rooms.index' || Route::currentRouteName() == 'provider.class-rooms.create' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#class-room" class="collapsed" aria-expanded="false">
                        <i class="fas fa-chalkboard"></i>
                        <p>{{ __('message.Class Rooms') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="class-room">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('provider.class-rooms.create') }}">
                                    <span class="sub-item">{{ __('message.Add') }}</span>
                                </a>
                                <a href="{{ route('provider.class-rooms.index') }}">
                                    <span class="sub-item">{{ __('message.List') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li
                    class="nav-item {{ Route::currentRouteName() == 'provider.units.index' || Route::currentRouteName() == 'provider.units.create' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#units" class="collapsed" aria-expanded="false">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>{{ __('message.Units') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="units">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('provider.units.create') }}">
                                    <span class="sub-item">{{ __('message.Add') }}</span>
                                </a>
                                <a href="{{ route('provider.units.index') }}">
                                    <span class="sub-item">{{ __('message.List') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li
                    class="nav-item {{ Route::currentRouteName() == 'provider.lessons.index' || Route::currentRouteName() == 'provider.lessons.create' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#lessons" class="collapsed" aria-expanded="false">
                        <i class="fas fa-book"></i>
                        <p>{{ __('message.Lessons') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="lessons">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('provider.lessons.create') }}">
                                    <span class="sub-item">{{ __('message.Add') }}</span>
                                </a>
                                <a href="{{ route('provider.lessons.index') }}">
                                    <span class="sub-item">{{ __('message.List') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li
                    class="nav-item {{ Route::currentRouteName() == 'provider.attachments.index' || Route::currentRouteName() == 'provider.attachments.create' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#attachments" class="collapsed" aria-expanded="false">
                        <i class="fas fa-file"></i>
                        <p>{{ __('message.Attachments') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="attachments">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('provider.attachments.create') }}">
                                    <span class="sub-item">{{ __('message.Add') }}</span>
                                </a>
                                <a href="{{ route('provider.attachments.index') }}">
                                    <span class="sub-item">{{ __('message.List') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>