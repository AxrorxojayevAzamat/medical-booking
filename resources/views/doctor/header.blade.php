<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html"><img src="/img/logo.png" data-retina="true" alt="" width="163" height="36"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>



    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item">
                <a class="nav-link" href="{{route('doctor.profile')}}">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">{{trans('menu.profile_details')}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('doctor.doctorbookings', Auth::user()) }}">
                    <i class="fa fa-fw fa-calendar-check-o"></i>
                    <span class="nav-link-text">{{trans('menu.my_records')}} 
                    @if($book_num)
                        <span class="badge badge-pill badge-primary float-right" style="margin-right: 20px;">{{$book_num}} {{trans('menu.new')}} </span></span>
                    @endif                
                </a>
            </li>
            <li class="nav-item">
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
                    @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class="py-1 px-3">
                            <a hreflang="{{ $localeCode }}"
                               href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li style="color: white; margin-left: 5px">
                <a class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">{{trans('menu.logout')}}</a>
            </li>
        </ul>
    </div>
</nav>


@include('doctor.adaptation_style')
