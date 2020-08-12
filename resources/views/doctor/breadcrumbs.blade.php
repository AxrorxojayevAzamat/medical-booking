<div class="container-fluid">
    @php
        Config::set('breadcrumbs.view', 'partials.admin.breadcrumbs');
    @endphp 
    @section('breadcrumbs', Breadcrumbs::render())

    @yield('breadcrumbs')
</div>