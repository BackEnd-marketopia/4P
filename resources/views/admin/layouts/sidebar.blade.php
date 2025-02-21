<div class="sidebar" data-background-color="white">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="white">
            <a href="{{ route('admin.index') }}" class="logo">
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
                <li class="nav-item {{ Route::currentRouteName() == 'admin.index' ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}">
                        <i class="fas fa-home"></i>
                        <p>{{ __('message.Dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'admin.player_forms.index' ? 'active' : '' }}">
                    <a href="{{ route('admin.player_forms.index') }}">
                        <i class="fas fa-file-alt"></i>
                        <p>{{ __('message.Player Forms') }}</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.categories.index' || Route::currentRouteName() == 'admin.categories.create' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#Categories" class="collapsed" aria-expanded="false">
                        <i class="fas fa-tags"></i>
                        <p>{{ __('message.Categories') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="Categories">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.categories.create') }}">
                                    <span class="sub-item">{{ __('message.Add') }}</span>
                                </a>
                                <a href="{{ route('admin.categories.index') }}">
                                    <span class="sub-item">{{ __('message.List') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.banners.index' || Route::currentRouteName() == 'admin.banners.create' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#Banners" class="collapsed" aria-expanded="false">
                        <i class="fas fa-image"></i>
                        <p>{{ __('message.Banners') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="Banners">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.banners.create') }}">
                                    <span class="sub-item">{{ __('message.Add') }}</span>
                                </a>
                                <a href="{{ route('admin.banners.index') }}">
                                    <span class="sub-item">{{ __('message.List') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.feeds.index' || Route::currentRouteName() == 'admin.feeds.create' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#Feeds" class="collapsed" aria-expanded="false">
                        <i class="fas fa-newspaper"></i>
                        <p>{{ __('message.Feeds') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="Feeds">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.feeds.create') }}">
                                    <span class="sub-item">{{ __('message.Add') }}</span>
                                </a>
                                <a href="{{ route('admin.feeds.index') }}">
                                    <span class="sub-item">{{ __('message.List') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.users.index' || Route::currentRouteName() == 'admin.users.create' || Route::currentRouteName() == 'admin.admins.index' || Route::currentRouteName() == 'admin.admins.create' || Route::currentRouteName() == 'admin.providers.index' || Route::currentRouteName() == 'admin.providers.create' || Route::currentRouteName() == 'admin.vendors.index' || Route::currentRouteName() == 'admin.vendors.create' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#user_types" class="collapsed" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <p>{{ __('message.User Types') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="user_types">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.admins.index') }}">
                                    <span class="sub-item">{{ __('message.Admins') }}</span>
                                </a>
                                <a href="{{ route('admin.providers.index') }}">
                                    <span class="sub-item">{{ __('message.Providers') }}</span>
                                </a>
                                <a href="{{ route('admin.vendors.index') }}">
                                    <span class="sub-item">{{ __('message.Vendos') }}</span>
                                </a>
                                <a href="{{ route('admin.users.index') }}">
                                    <span class="sub-item">{{ __('message.Users') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'admin.codes.index' ? 'active' : '' }}">
                    <a href="{{ route('admin.codes.index') }}">
                        <i class="fas fa-key"></i>
                        <p>{{ __('message.Codes') }}</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ Route::currentRouteName() == 'admin.notifications.index' || Route::currentRouteName() == 'admin.notifications.create' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#Notifications" class="collapsed" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <p>{{ __('message.Notifications') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="Notifications">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.notifications.create') }}">
                                    <span class="sub-item">{{ __('message.Add') }}</span>
                                </a>
                                <a href="{{ route('admin.notifications.index') }}">
                                    <span class="sub-item">{{ __('message.List') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'admin.ads.index' ? 'active' : '' }}">
                    <a href="{{ route('admin.ads.index') }}">
                        <i class="fas fa-bullhorn"></i>
                        <p>{{ __('message.Advertisements') }}</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'admin.cities.index' ? 'active' : '' }}">
                    <a href="{{ route('admin.cities.index') }}">
                        <i class="fas fa-globe"></i>
                        <p>{{ __('message.Cities') }}</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'admin.config' ? 'active' : '' }}">
                    <a href="{{ route('admin.config') }}">
                        <i class="fas fa-cog"></i>
                        <p>{{ __('message.Configurations') }}</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>