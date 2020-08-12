<!DOCTYPE html>
<html>

    @include('layouts.cabinet.head')

<body>
    @include('doctor.header')
    @section('breadcrumbs', Breadcrumbs::render())
    {{-- @section('breadcrumbs', '') --}}
    
    @yield('content')

    @include('layouts.cabinet.footer')

    @yield('js')
    
</body>
	
</html>