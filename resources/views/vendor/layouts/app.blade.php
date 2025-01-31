<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/app_logo.png') }}" type="image/x-icon" />
    <!-- RTL Support -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom-rtl.css') }}" />
    <!-- Fonts and icons -->
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
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
</head>
<body>
    <div class="wrapper">
        @include('admin.layouts.sidebar')

        <div class="main-panel">
            @include('admin.layouts.header')
            @if(session()->has('success'))
                <br><br><br><br>
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
            @endif
            @if(session()->has('error'))
                <br><br><br><br>
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            @yield('content')
            @include('admin.layouts.footer')
        </div>
    </div>
</body>
<script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>

<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

<script src="{{ asset('assets/js/setting-demo.js') }}"></script>
<script src="{{ asset('assets/js/demo.js') }}"></script>
<script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
    });
</script>
<script>
    $(document).ready(function () {
            $("#basic-datatables").DataTable({
                searching: true, // Enables search
                paging: false, // Disable pagination if not needed
                info: false, // Hide table info (optional)
            });

            $("#multi-filter-select").DataTable({
                searching: true, // Enables search
                paging: false,
                info: false,
            });

            $("#add-row").DataTable({
                searching: true, // Enables search
                paging: false,
                info: false,
            });
        });
</script>
</body>

</html>