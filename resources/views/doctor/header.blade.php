<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html"><img src="img/logo.png" data-retina="true" alt="" width="163" height="36"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{route('doctor.profile')}}">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">{{trans('menu.profile')}}</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Bookings">
                <a class="nav-link" href="{{ route('doctor.doctorbookings', Auth::user()) }}">
                    <i class="fa fa-fw fa-calendar-check-o"></i>
                    <span class="nav-link-text">{{trans('menu.my_records')}} 
                    @if($book_num)
                        <span class="badge badge-pill badge-primary">{{$book_num}} {{trans('menu.new')}} </span></span>
                    @endif                
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Bookings">
                <a class="nav-link" href="{{ route('doctor.timetable') }}">
                    <i class="fa fa-fw fa-calendar-check-o"></i>
                    <span class="nav-link-text">{{trans('menu.timetable')}}
                </a>
            </li>
        </ul>
        
        <ul class="navbar-nav ml-auto">
            <li class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">{{ trans('menu.language') }}</button>
                <ul class="dropdown-menu">
                    <li><a href="/locale/uz">Uz</a></li>
                    <li><a href="/locale/ru">Ру</a></li>
                </ul>
            </li>
            <li style="color: white; margin-left: 5px">
                <a class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">{{trans('menu.logout')}}</a>
            </li>
        </ul>
    </div>
</nav>
