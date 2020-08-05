<!DOCTYPE html>
<html>

    @include('layouts.cabinet.head')

<body>
    @include('patient.header')

    @yield('content')

    @include('layouts.cabinet.footer')

    @yield('js')

</body>

</html>