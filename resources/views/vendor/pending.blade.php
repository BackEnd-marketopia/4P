<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('message.title') }}</title>
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/app_logo.png') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="bg-white p-4 rounded shadow text-center position-relative" style="max-width: 500px;">

        <!-- Language Dropdown: Adjusted for better positioning -->
        <div class="text-end mb-3">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="languageDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ __('message.Language') }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                    <li><a class="dropdown-item" href="{{ route('setLocale', 'en') }}">{{ __('message.English') }}</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('setLocale', 'ar') }}">{{ __('message.Arabic') }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <h1 class="text-dark fw-bold">{{ __('message.title') }}</h1>
        <p class="text-secondary">
            {{ __('message.message') }}
        </p>

        <div class="mt-3">
            <svg class="w-25 h-25 text-warning animate-pulse" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <p class="text-muted mt-3">{{ __('message.warning') }}</p>

        {{-- <a href="#" class="btn btn-primary mt-3">
            {{ __('message.home') }}
        </a> --}}
        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-danger">
                {{ __('message.Logout') }}
            </button>
        </form>
    </div>

</body>

</html>