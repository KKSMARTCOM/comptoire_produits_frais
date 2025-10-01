<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CPF Espace admin</title>
    <!-- plugins:js -->
    <script src="{{ asset('backend') }}/js/jquery.min.js"></script>

    <script src="{{ asset('backend') }}/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/css/vertical-layout-light/style.css">

    <link href="{{ asset('backend') }}/css/bootstrap-toggle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('backend') }}/css/alertify.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/css/alertify-bootstrap.min.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- script select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @yield('customcss')

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('backend.inc.header')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->

            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            @include('backend.inc.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('backend.inc.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


    <!-- Plugin js for this page -->
    <script src="{{ asset('backend') }}/vendors/chart.js/Chart.min.js"></script>
    <script src="{{ asset('backend') }}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ asset('backend') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('backend') }}/js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('backend') }}/js/off-canvas.js"></script>
    <script src="{{ asset('backend') }}/js/hoverable-collapse.js"></script>
    <script src="{{ asset('backend') }}/js/template.js"></script>
    <script src="{{ asset('backend') }}/js/settings.js"></script>
    <script src="{{ asset('backend') }}/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('backend') }}/js/dashboard.js"></script>
    <script src="{{ asset('backend') }}/js/Chart.roundedBarCharts.js"></script>
    <script src="{{ asset('backend') }}/js/file-upload.js"></script>

    <script src="{{ asset('backend') }}/js/bootstrap-toggle.min.js"></script>

    <script src="{{ asset('backend') }}/js/alertify.min.js"></script>


    @yield('customjs')
    <!-- End custom js for this page-->
</body>

</html>
