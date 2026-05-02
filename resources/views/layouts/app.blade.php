<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Granny Restaurant</title>
    <link href="{{ asset('assets/images/favicon/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/css/external.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/revolution/css/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/revolution/css/navigation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body>

    <div class="preloader">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <div id="wrapper" class="wrapper clearfix">
        @yield('content') 
    </div>

    <script src="{{ asset('assets/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/functions.js') }}"></script>

    <script src="{{ asset('assets/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

    <script src='https://cdn.jsdelivr.net/npm/flatpickr'></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#res-datepicker", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d", 
            minDate: "today",    // Prevents users from booking in the past
            disableMobile: "true"
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#res-timepicker", {
            enableTime: true,
            noCalendar: true,    // Hides the calendar, shows only the clock
            dateFormat: "H:i",    // 24-hour format (e.g., 20:00)
            altInput: true,
            altFormat: "h:i K",  
            time_24hr: false,     // Enables AM/PM selection
            minuteIncrement: 15  
        });
    });
</script>
@stack('scripts')
</body>
</html>