<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AUSphere</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('src/assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('src/assets/vendors/mdi/css/materialdesignicons.min.css') }}"> --}}

    {{-- summer note css  --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">


    <!-- endinject -->
    {{-- <link rel="shortcut icon" href="{{ asset('src/assets/images/favicon.png') }}" /> --}}

    {{-- <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script> --}}

    {{-- for dashboard css ui  --}}
    <link rel="stylesheet" href="{{ asset('src/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/css/toastr.min.css') }}">

    <!-- Summernote CSS -->

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @yield('css')
</head>

<body>

    <div class="loader-container">
        <div class="loader-content">
            <span class="loader"></span>
        </div>
    </div>

{{-- navbar --}}
<div class="container-fluid page-body-wrapper">
        @include('layouts.navbar')
        {{-- sidebar --}}
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            {{-- <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025.
                        <a href="#" target="_blank">AUSphere</a>. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
                        <i class="ti-heart text-danger ms-1"></i></span>
                </div>
            </footer> --}}
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>

    {{-- vendor.bundle.base.js is jquery and bootstrap file bundle --}}
     <script src="{{ asset('src/assets/vendors/js/vendor.bundle.base.js') }}"></script>

    <script src="{{ asset('src/assets/js/template.js') }}"></script>
    <script src="{{ asset('src/assets/js/off-canvas.js') }}"></script>
    {{-- toastr js  --}}
    {{-- sweetalert2 --}}
    <script src="{{ asset('src/assets/js/sweetalert2@11.js') }}"></script>

    <script src="{{ asset('src/assets/js/toastr.min.js') }}"></script>

    <!-- Summernote Bootstrap 5 compatible version by community-->

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    @include('layouts.sweetalert-message')
    {{-- <script src="{{ asset('src/assets/js/pusher.js') }}"></script> --}}
    {{-- <script src="{{ asset('src/assets/js/pusher.min.js') }}"></script> --}}

    <script src="{{ asset('js/custom.js') }}"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script> --}}




    {{-- <script src="{{ asset('src/assets/js/pusher.js') }}"></script> --}}
    {{-- <script src="{{ asset('src/assets/js/pusher.min.js') }}"></script> --}}


    {{-- <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script> --}}

    @stack('js')

</body>

</html>
