<!DOCTYPE html>
<html lang="en">

<head>
    <title>CPF Boutique en ligne</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('/') }}css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/owl.theme.default.min.css">

    <link rel="stylesheet" href="{{ asset('/') }}css/aos.css">

    <link rel="stylesheet" href="{{ asset('/') }}css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.css">

    {{-- LEAFTCSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- TAILWIND --}}
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

    <div class="site-wrap">
        @include('frontend.inc.header')

        @yield('content')

        @include('frontend.inc.footer')
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- LEAFTJS --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    @yield('customjs')

    <script>
        @if (session()->get('success'))
            toastr.success("{{ session()->get('success') }}")
        @endif

        /* document.addEventListener('DOMContentLoaded', function() {
            var navbar = document.getElementById('site-navigation');
            var sticky = 280;

            function handleScroll() {
                if (window.pageYOffset >= sticky) {
                    navbar.classList.add('fixed');
                } else {
                    navbar.classList.remove('fixed');
                }
            }
            window.addEventListener('scroll', handleScroll)
        }) */
    </script>

</body>

</html>
