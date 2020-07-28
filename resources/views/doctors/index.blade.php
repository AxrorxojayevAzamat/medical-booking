@extends('layouts.app')

@section('content')

    <form action="?" method="GET">
        <div id="results" style="padding: 0 0 20px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h4>{!! trans('doctors.showing_results', ['current' => $countCurrent, 'all' => $countAll]) !!}</h4>
                    </div>
                    <div class="col-md-3">
                        <ul class="row">
                            <li class="{{ Request::is('doctors*') ? 'active' : '' }}" style="margin: auto 10px auto 30px;">
                                <a href="{{ route('doctors.index') }}">Doctor</a>
                            </li>
                            <li class="{{ Request::is('clinics*') ? 'active' : '' }}" style="margin: auto 10px;">
                                <a href="{{ route('clinics.index') }}">Clinic</a>

                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="search_bar_list">
                            <input type="text" class="form-control" name="full_name" placeholder="{{trans('doctors.search_placeholder')}}" aria-label="Search" value="{{ request('full_name') }}">
                            <input type="submit" value="{{trans('adminlte.search')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="filters_listing">
            <div class="container-fluid">
                <ul class="clearfix row d-flex justify-content-center">
                    <li>
                        <h6>Поиск по клиникам...</h6>
                        <div class="form-group">
                            <select id="clinic_id" name="clinic">
                                <option value=""></option>
                                @foreach ($clinics as $value => $label)
                                    <option value="{{ $value }}"{{ $value == request('clinic') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li style="margin-right: 10px">
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

                        <h3>{{$doctorValue->profile ? $doctorValue->profile->fullName : ''}}</h3>
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

                        <ul>
                            @if(empty($doctorValue->clinics->pluck('location')->toArray()))
                                <li><a href="#0" onclick="initMap()" class="btn_listing"></a></li>
                            @else
                                <li><a href="#0" onclick="initMap({{$doctorValue->clinics->pluck('location')->first()}})" class="btn_listing">{{trans('doctors.view_on_map')}}</a></li>
                            @endif
                            <li><a href="{{ route('doctors.show', $doctorValue) }}">{{ trans('doctors.booking') }}</a></li>
                        </ul>
                    </div>
                    <ul>
                        @foreach($doctorValue->clinics as $clinic)
                        <li><a href="{{ route('clinics.show', $clinic) }}">{{'clinic_name: '.$clinic->name }}</a></li>
                        <img src="{{asset($clinic->mainPhoto ? $clinic->mainPhoto->fileThumbnail : '/img/565x565.jpg')}}" width="50" height="50" alt="">
                        @endforeach
                    </ul>
                    @endforeach
                    <!-- /strip_list -->

                    {{ $doctors->links() }}
                    <!-- /pagination -->
                </div>
                <!-- /col -->

                <aside class="col-lg-5" id="sidebar">
                    <div id="map_listing" class="normal_list">
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <style>
        #map { height: 500px; width: 600px; }
    </style>

    <body>
    <div id="map"></div>
    <script>
        var map = L.map('map').setView([41.311081, 69.240562], 12);
        L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=Xfgr995Ff02GXMwQcwYP',{
            attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
        }).addTo(map);
        
        var greenIcon = L.icon({
    iconUrl: '/img/icons/clinic.png',
    iconSize:     [50, 50], // size of the icon
    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});
    L.marker([41.311081, 69.240562],{icon:greenIcon}).addTo(map).bindPopup('CLINIC N1 Phone:+998*******');
    L.marker([41.274290, 69.204554],{icon:greenIcon}).addTo(map).bindPopup('CLINIC N2 Phone:+998*******');
    //L.marker([41.274290, 69.204554],{icon:greenIcon}).addTo(map).bindPopup('CLINIC N3 Phone:+998*******');

/* var polygon = L.polygon([
    [51.509, -0.08],
    [51.503, -0.06],
    [51.51, -0.047]
]).addTo(map);
*/
    </script>
    </body>
                    </div>
                </aside>
                <!-- /aside -->

                {{ $doctors->links() }}
            </div>

            <aside class="col-lg-5" id="sidebar">
                <div id="map_listing" class="normal_list">
                </div>
            </aside>
        </div>
    <label>
    
{{ $clinicLocationsJson  }}
</label>
@endsection

@section('scripts')
<script>
    $('#region_id').select2();
    $('#clinic_id').select2();
    $('#specialization_id').select2();
</script>
@endsection
