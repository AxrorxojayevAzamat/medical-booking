<!DOCTYPE html>
<html>

    @include('layouts.head')

<body>
    @include('patient.header')

    @yield('content')

    @include('doctor.footer')

</body>

</html>