<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="white">
            <a href="{{ route('admin.profileMe') }}" class="logo">
                <img src="{{ asset(auth('web')->user()->image) }}" alt="navbar brand" class="navbar-brand" height="20" />
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
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <!-- Language Dropdown -->
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="gg-globe"></i> {{ __('message.Language') }}
                    </a>
                    <ul class="dropdown-menu animated fadeIn">
                        <li>
                            <a class="dropdown-item" href="{{ route('setLocale', 'en') }}">{{ __('message.English') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('setLocale', 'ar') }}">{{ __('message.Arabic') }}</a>
                        </li>
                    </ul>
                </li>
                <!-- End Language Dropdown -->
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ asset(auth('web')->user()->image) }}" alt="..." class="avatar-img rounded-circle" />
                        </div>
                        <span class="profile-username">
                            <span class="op-7">{{ __('message.Hi') }},</span>
                            <span class="fw-bold">{{ auth('web')->user()->name }}</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="{{ asset(auth('web')->user()->image) }}" alt="image profile"
                                            class="avatar-img rounded" />
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ auth('web')->user()->name }}</h4>
                                        <p class="text-muted">{{ auth('web')->user()->email }}</p>
                                        <a href="{{ route('admin.profileMe') }}" class="btn btn-xs btn-secondary btn-sm">{{ __('message.View Profile') }}</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.profileMe') }}">{{ __('message.My Profile') }}</a>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('message.Logout') }}
                                </a>
                                
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>