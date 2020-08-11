@extends('layouts.app')

@section('content')

    <form action="?" method="GET">
        <div id="results">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12 pb-3">
                        <h4>{!! trans('doctors.showing_results', ['current' => $countCurrent, 'all' => $countAll]) !!}</h4>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <ul class="row">
                            <li class="{{ Request::is('*/doctors*') ? 'active' : '' }}" style="margin: auto 10px auto 30px;">
                                <a href="{{ route('doctors.index') }}">{{ trans('menu.doctors') }}</a>
                            </li>
                            <li class="{{ Request::is('*/clinics*') ? 'active' : '' }}" style="margin: auto 10px;">
                                <a href="{{ route('clinics.index') }}">{{ trans('menu.clinics') }}</a>

                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="search_bar_list">
                            <input type="text" name="full_name" class="form-control" placeholder="{{trans('doctors.search_placeholder')}}" aria-label="Search" value="{{ request('full_name') }}">
                            <input type="submit" value="{{trans('adminlte.search')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="filters_listing">
            <div class="container-fluid">
                <ul class="clearfix row d-flex justify-content-center">
                    {{-- <li>
                        <h6>Layout</h6>
                        <div class="layout_view">
                            <a href="grid-list.html"><i class="icon-th"></i></a>
                            <a href="#0" class="active"><i class="icon-th-list"></i></a>
                            <a href="list-map.html"><i class="icon-map-1"></i></a>
                        </div>
                    </li> --}}
                    {{-- <li>
                        <h6>Поиск по имени...</h6>
                        <div class="form-group">
                            <input class="form-control" name="full_name" type="search" placeholder="ФИО" aria-label="Search" value="{{ request('full_name') }}">
                        </div>
                    </li> --}}
                    <li>
                        <h6>{{trans('filter.search_clinics')}}</h6>
                        <div class="form-group">
                            <select id="clinic_id" name="clinic">
                                <option value=""></option>
                                @foreach ($clinics as $value => $label)
                                    <option value="{{ $value }}"{{ $value == request('clinic') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </li >
                    <li style="margin-right: 10px">
                        <h6>{{trans('filter.search_regions')}}</h6>
                        <select id="region_id" name="region">
                            <option value=""></option>
                            @foreach ($regions as $value => $label)
                                <option value="{{ $value }}"{{ $value == request('region') ? ' selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <h6>{{trans('filter.sex')}}</h6>
                        <select name="gender" id="sex_id">
                            <option value=""></option>
                            <option value="{{ \App\Entity\User\Profile::MALE }}"{{ \App\Entity\User\Profile::MALE == request('gender') ? ' selected' : '' }}>{{ trans('filter.male') }}</option>
                            <option value="{{ \App\Entity\User\Profile::FEMALE }}"{{ \App\Entity\User\Profile::FEMALE == request('gender') ? ' selected' : '' }}>{{ trans('filter.female') }}</option>
                        </select>
                    </li>
                    <li>
                        <h6>{{trans('filter.search_specializations')}}</h6>
                        <select id="specialization_id" name="specialization">
                            <option value=""></option>
                            @foreach ($specializations as $value => $label)
                                <option value="{{ $value }}"{{ $value == request('specialization') ? ' selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <h6>{{trans('filter.filter_by')}}</h6>
                        <select name="order_by" id="order_id">
                            <option value=""></option>
                            <option value="alphabet"{{ 'alphabet' == request('order_by') ? ' selected' : '' }}>{{trans('filter.alphabet')}}</option>
                            <option value="best_rated"{{ 'best_rated' == request('order_by') ? ' selected' : '' }}>{{trans('filter.rating')}}</option>
                        </select>
                    </li>
                    <li>
                        <div class="form-group" style="margin: auto 0;">
                            {{-- <button type="submit" class="btn btn-primary btn-search">Искать</button> --}}
                            <a href="?" class="btn btn-outline-secondary btn-clear">{{trans('filter.clear')}}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </form>

    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-7">

                @foreach($doctors as $doctorKey => $doctorValue)
                    <div class="strip_list wow fadeIn">
                        <figure>
                            @if($doctorValue->profile->image)
                                <img src="{{asset($doctorValue->profile->image)}}" alt="">
                            @else
                                <img src="{{asset('/img/565x565.jpg')}}" alt="">
                            @endif

                        </figure>
                        @foreach($doctorValue->specializations as $spec)
                            <small>{{$spec->name}}</small>
                        @endforeach
                        <h3><a href="{{ route('doctors.show',$doctorValue) }}">{{$doctorValue->profile ? $doctorValue->profile->fullName : ''}}</a></h3>
                        <p>{{$doctorValue->profile ? substr($doctorValue->profile->about, 0, 120) . ' . . . ' : ''}}</p>

                        <?php $average = number_format($doctorValue->profile->rate/($doctorValue->profile->num_of_rates?:1), 1, '.', ''); ?>

                        <span class="rating">{{trans('doctors.average_rating')}} {{ $average }} <small>({{ $doctorValue->profile->num_of_rates }})</small></span>
                        @if($average>4 && $average<=5)
                            <img src="{{URL::to('img/badges/badge_1.svg')}}" width="15" height="15" alt="">
                        @elseif($average>3 && $average<=4)
                            <img src="{{URL::to('img/badges/badge_2.svg')}}" width="15" height="15" alt="">
                        @elseif($average>2 && $average<=3)
                            <img src="{{URL::to('img/badges/badge_3.svg')}}" width="15" height="15" alt="">
                        @elseif($average>1 && $average<=2)
                            <img src="{{URL::to('img/badges/badge_4.svg')}}" width="15" height="15" alt="">
                        @elseif($average>0 && $average<=1)
                            <img src="{{URL::to('img/badges/badge_5.svg')}}" width="15" height="15" alt="">
                        @endif

                        <p>
                            <span class="rating">Бронирован: {{ $doctorValue->numberOfBookings }}</span>
                        </p>

                        <ul style="height: 4em;">
                            {{-- @if(empty($doctorValue->clinics->pluck('location')->toArray()))
                                <li><a href="#0" onclick="initMap()" class="btn_listing"></a></li>
                            @else
                                <li><a href="#0" onclick="initMap({{$doctorValue->clinics->pluck('location')->first()}})" class="btn_listing">{{trans('doctors.view_on_map')}}</a></li>
                            @endif --}}
                            <li><a href="{{ route('doctors.show',$doctorValue) }}">{{trans('doctors.booking')}}</a></li>
                        </ul>
                    </div>


                @endforeach
                {{ $doctors->links() }}

            </div>
            <!-- /col -->

            <aside class="col-lg-5" id="sidebar">
                <div id="map_listing" class="normal_list">
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
                    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>

                    <style>
                        #map { height: 550px; width: 599px; }
                    </style>
                    </head>
                    {{-- <body> --}}
                    <div id="map"></div>

                    <script>
                        var map = L.map('map').setView([41.311081, 69.240562], 12);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {foo: 'bar', attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'})
                            .addTo(map);

                        L.marker([{"doctorId":53,"locations":["41.2704736,69.2134647","41.3191884,69.2382324"]},{"doctorId":42,"locations":["41.2704736,69.2134647"]},{"doctorId":39,"locations":["41.3191884,69.2382324","41.2704736,69.2134647","41.2704736,69.2134647"]},{"doctorId":4,"locations":["41.2981861,69.2120876"]},{"doctorId":44,"locations":["41.3191884,69.2382324","41.2704736,69.2134647"]}])

                    </script>
                    {{-- </body>  --}}
                </div>
            </aside>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $('#region_id').select2();
    $('#clinic_id').select2();
    $('#specialization_id').select2({
        width: "170px"
    });
    $('#order_id').select2({
        width: "150px",
    });
    $('#sex_id').select2({
        width: "150px",
    });


</script>
@endsection
