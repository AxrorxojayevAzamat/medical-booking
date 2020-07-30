<!DOCTYPE html>
<html>

    @include('layouts.head')
    <head>
        <link href="{{asset('vendor/select2/css/select2.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/doctor-spec.css')}}" rel="stylesheet">
    </head>

<body>
    @include('doctor.header')

    @yield('content')

    @include('doctor.footer')
    
</body>

</html>