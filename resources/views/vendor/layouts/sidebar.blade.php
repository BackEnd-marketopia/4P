<div class="sidebar" data-background-color="white">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="white">
            <a href="{{ route('vendor.home') }}" class="logo">
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
                <li class="nav-item {{ Route::currentRouteName() == 'vendor.home' ? 'active' : '' }}">
                    <a href="{{ route('vendor.home') }}">
                        <i class="fas fa-home"></i>
                        <p>{{ __('message.Home') }}</p>
                    </a>
                </li>  
                <li class="nav-item {{ Route::currentRouteName() == 'vendor.profile' ? 'active' : '' }}">
                    <a href="{{ route('vendor.profile') }}">
                        <i class="fas fa-user-tie"></i>
                        <p>{{ __('message.My Profile') }}</p>
                    </a>
                </li>
            <li class="nav-item {{ Route::currentRouteName() == 'vendor.discounts.index' || Route::currentRouteName() == 'vendor.discounts.create' ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#Discount" class="collapsed" aria-expanded="false">
                    <i class="fas fa-tags"></i>
                    <p>{{ __('message.Discount') }}</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="Discount">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="{{ route('vendor.discounts.create') }}">
                                <span class="sub-item">{{ __('message.Add') }}</span>
                            </a>
                            <a href="{{ route('vendor.discounts.index') }}">
                                <span class="sub-item">{{ __('message.List') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        {{--<li class="nav-item {{ Route::currentRouteName() == 'admin.banners.index' || Route::currentRouteName() == 'admin.banners.create' ? 'active' : '' }}">
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

            <li class="nav-item {{ Route::currentRouteName() == 'admin.feeds.index' || Route::currentRouteName() == 'admin.feeds.create' ? 'active' : '' }}">
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
            </li> --}}
            </ul>
        </div>
    </div>
</div>