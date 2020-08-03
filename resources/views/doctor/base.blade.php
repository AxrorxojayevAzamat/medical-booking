<!DOCTYPE html>
<html>

    @include('layouts.head')
    
    <head>
        <link href="{{asset('vendor/select2/css/select2.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/bootstrap-fileinput/css/fileinput.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/bootstrap-fileinput/css/fileinput-rtl.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/daterangepicker/daterangepicker.css')}}" rel="stylesheet">
        <link href="{{asset('css/date_picker.css')}}" rel="stylesheet">
        <link href="{{asset('css/doctor-spec.css')}}" rel="stylesheet">
    </head>
<body>
    @include('doctor.header')

    @yield('content')

    @include('doctor.footer')
    
</body>
	
</html>