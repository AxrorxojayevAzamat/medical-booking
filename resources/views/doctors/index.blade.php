@extends('layouts.app')

@section('content')

<div id="page">
    <main class="theia-exception">
        <div id="results">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h4>{!! trans('doctors.showing_results', ['current' => $countCurrent, 'all' => $countAll]) !!}</h4>
                    </div>
                    <div class="col-md-3">
                        <ul class="row">
                            <li style="margin: auto 10px auto 30px;">
                                <input type="radio" id="doctor" name="radio_search" value="doctor" checked>
                                <label for="doctor">Doctor</label>
                            </li>
                            <li style="margin: auto 10px;">
                                <input type="radio" id="clinic" name="radio_search" value="clinic">
                                <label for="clinic">Clinic</label>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="search_bar_list">
                            <input type="text" class="form-control" placeholder="{{trans('doctors.search_placeholder')}}">
                            <input type="submit" value="{{trans('adminlte.search')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="filters_listing">
            <div class="container-fluid">
                <form action="?" method="GET">
                    <ul class="clearfix row d-flex justify-content-center">
                        {{-- <li>
                            <h6>Layout</h6>
                            <div class="layout_view">
                                <a href="grid-list.html"><i class="icon-th"></i></a>
                                <a href="#0" class="active"><i class="icon-th-list"></i></a>
                                <a href="list-map.html"><i class="icon-map-1"></i></a>
                            </div>
                        </li> --}}
                        <li>
                            <h6>Поиск по имени...</h6>
                            <div class="form-group">
                                <input class="form-control" name="full_name" type="search" placeholder="ФИО" aria-label="Search" value="{{ request('full_name') }}">
                            </div>
                        </li>
                        <li style="margin-right: 10px">
                            <h6>Поиск по клиником...</h6>
                            <div class="form-group">
                                <select id="clinic_id" name="clinic">
                                    <option value=""></option>
                                    @foreach ($clinics as $value => $label)
                                    <option value="{{ $value }}"{{ $value == request('clinic') ? ' selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </li >
                        <li>
                            <h6>Поиск по регионам...</h6>
                            <select id="region_id" name="region">
                                <option value=""></option>
                                @foreach ($regions as $value => $label)
                                <option value="{{ $value }}"{{ $value == request('region') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <h6>Пол</h6>
                            <select name="gender" class="selectbox">
                                <option value=""></option>
                                <option value="{{ \App\Entity\User\Profile::MALE }}"{{ \App\Entity\User\Profile::MALE == request('gender') ? ' selected' : '' }}>Мужчина</option>
                                <option value="{{ \App\Entity\User\Profile::FEMALE }}"{{ \App\Entity\User\Profile::FEMALE == request('gender') ? ' selected' : '' }}>Женщина</option>
                            </select>
                        </li>
                        <li>
                            <h6>Поиск по специализациям...</h6>
                            <select id="specialization_id" name="specialization">
                                <option value=""></option>
                                @foreach ($specializations as $value => $label)
                                <option value="{{ $value }}"{{ $value == request('specialization') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <h6>Сортировка по</h6>
                            <select name="order_by" class="selectbox" multiple>
                                <option value=""></option>
                                <option value="alphabet"{{ 'alphabet' == request('order_by') ? ' selected' : '' }}>Алфавиту</option>
                                <option value="best_rated"{{ 'best_rated' == request('order_by') ? ' selected' : '' }}>Рейтингу</option>
                            </select>
                        </li>
                        <li>
                            <div class="form-group" style="margin: auto 0;">
                                <button type="submit" class="btn btn-primary btn-search">Искать</button>
                                <a href="?" class="btn btn-outline-secondary btn-clear">Очистить</a>
                            </div>
                        </li>
                        {{-- <li style="margin: auto 10px auto 30px;">
                            <input type="radio" id="doctor" name="radio_search" value="doctor" checked>
                            <label for="doctor">Doctor</label>
                          </li>
                          <li style="margin: auto 10px;">
                            <input type="radio" id="clinic" name="radio_search" value="clinic">
                            <label for="clinic">Clinic</label>
                          </li> --}}
                    </ul>
                </form>
            </div>
        </div>

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
                        <span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i> <small>(145)</small></span>
                        <a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="img/badges/badge_1.svg" width="15" height="15" alt=""></a>
                        <ul>
                            @if(empty($doctorValue->clinics->pluck('location')->toArray()))
                            <li><a href="#0" onclick="initMap()" class="btn_listing"></a></li>
                            @else
                            <li><a href="#0" onclick="initMap({{$doctorValue->clinics->pluck('location')->first()}})" class="btn_listing">{{trans('doctors.view_on_map')}}</a></li>
                            @endif
                            <li><a href="{{ route('doctors.show',$doctorValue) }}">{{trans('doctors.booking')}}</a></li
                        </ul>
                    </div>

                    @endforeach
                    <!-- /strip_list -->

                    {{ $doctors->links() }}
                    <!-- /pagination -->
                </div>
                <!-- /col -->

                <aside class="col-lg-5" id="sidebar">
                    <div id="map_listing" class="normal_list">
                 <!--     /<head> 
                       <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
                             <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
                       
                       <style>
                           #map { height: 550px; width: 599px; }
                       </style>
                      </head>
                 <body>
                       <div id="map"></div>
                       
                    <script>
                            var map = L.map('map').setView([41.311081, 69.240562], 12);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {foo: 'bar', attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'})
                            .addTo(map);
        
                            var greenIcon = L.icon({
                                iconUrl: 'img/icons/clinic.png',
                                iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                                iconSize:     [50, 50], // size of the icon
                                popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                                    });

                            L.marker([41.2704736, 69.2134647],{icon:greenIcon}).addTo(map).bindPopup("<li><a href='{{ route('doctors.show',$doctorValue) }}'>{{trans('doctors.booking')}}>mnm </a></li>");


                            //L.marker([41.3191884, 69.2382324],{icon:greenIcon}).addTo(map).bindPopup(' <li><a href="#0" onclick="initMap(41.2646, 69.2163)" class="btn_listing">Показать на карте</a></li>');
                            //L.marker([41.2981861, 69.2120876],{icon:greenIcon}).addTo(map).bindPopup(' <li><a href="#0" onclick="initMap(41.2646, 69.2163)" class="btn_listing">Показать на карте</a></li>');
                    </script>
                </body> -->
                    </div>
                </aside> 
                <!-- /aside -->

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!-- /main -->

<label>
    
{{ $clinicLocationsJson  }}
</label>
</div>
@endsection

@section('scripts')
<script>
    $('#region_id').select2();
    $('#clinic_id').select2();
    $('#specialization_id').select2();
</script>
@endsection
