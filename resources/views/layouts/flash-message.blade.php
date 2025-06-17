
<link rel="stylesheet" href="{{ asset('src/assets/css/toastr.min.css') }}">
<script src="{{ asset('src/assets/js/toastr.min.js') }}"></script>
<script type="text/javascript">
        @if(session('success'))
            toastr.success("{{ session('success') }}", "Success");
        @endif

        @if(session('info'))
            toastr.info("{{ session('info') }}", "Info");
        @endif

        @if(session('warning'))
            toastr.warning("{{ session('warning') }}", "Warning");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}", "Error");
        @endif
    // });


</script>
