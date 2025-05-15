<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Verify</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/app_logo.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>

<body class="{{ $class ?? '' }}" style="background:#f7f7f7">
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            setTimeout(function () {
                document.getElementById('errorAlert').remove();
            }, 5000);
        </script>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            setTimeout(function () {
                document.getElementById('successAlert').remove();
            }, 5000);
        </script>
    @endif
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-white shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <a href="{{ url()->previous() }}" class="">
                                <i class="fas fa-arrow-left"></i> {{ __('message.Back') }}
                            </a>
                            <li class="nav-item dropdown hidden-caret" style="list-style: none;">
                                <a class="dropdown-toggle" href="#" id="languageDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('message.Language') }}
                                </a>
                                <ul class="dropdown-menu animated fadeIn" aria-labelledby="languageDropdown">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('setLocale', 'en') }}">{{ __('message.English') }}</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('setLocale', 'ar') }}">{{ __('message.Arabic') }}</a>
                                    </li>
                                </ul>
                            </li>
                        </div>
                        <div class="text-center text-muted mb-4">
                            <img src="{{ asset('assets/img/kaiadmin/app_logo.png') }}" alt="Logo" class="logo"
                                width="100">
                            </br>
                            <span style="font-weight: bold; font-size: 2em;">4P</span>
                        </div>
                        <form method="POST" action="{{ route('profile.verifyCode') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <input class="form-control" placeholder="{{ __('message.Verification Code') }}"
                                        type="text" name="code" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-muted mb-3">
                                    {{ __('message.We have sent you a verification code to your phone number') }}
                                </p>
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('message.Verify') }}
                                </button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <form method="POST" action="{{ route('profile.resendCode') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-redo-alt"></i>
                                    {{ __('message.Resend code') }}
                                </button>
                            </form>
                            <p class="text-muted small mt-2">
                                {{ __('message.Did not receive the code?') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>