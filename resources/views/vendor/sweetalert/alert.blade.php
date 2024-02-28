@if (config('sweetalert.alwaysLoadJS') === true && config('sweetalert.neverLoadJS') === false)
    <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
@endif

@if (Session::has('alert.config'))
    @if (config('sweetalert.animation.enable'))
        <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    @endif
    @if (config('sweetalert.alwaysLoadJS') === false && config('sweetalert.neverLoadJS') === false)
        <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @endif

    <script>
        // Retrieve the alert configuration from the session
        var alertConfig = {!! json_encode(Session::get('alert.config')) !!};
        console.log(alertConfig); // Log the alert configuration to the console
        debugger
        Swal.fire(alertConfig.title); // Display the alert using SweetAlert
    </script>
@endif
