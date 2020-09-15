@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/clinics_filter.css') }}" rel="stylesheet">
@endsection

@section('content')
    <form action="?" method="GET">
        <div id="results" style="padding: 0 0 20px 0;">
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
                            <input type="text" class="form-control" name="name" placeholder="{{trans('doctors.search_placeholder')}}" aria-label="Search" value="{{ request('name') }}">
                            <input type="submit" value="{{trans('adminlte.search')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="filters_listing">
            <div class="container">
                <ul class="clearfix row d-flex justify-content-center">
                    <li class="first">
                        <h6>{{trans('filter.search_regions')}}</h6>
                        <select id="region_id" name="region">
                            <option value=""></option>
                            @foreach ($regions as $value => $label)
                                <option value="{{ $value }}"{{ $value == request('region') ? ' selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li><h6>{{trans('filter.filter_by_service')}}</h6>
                        <select id="service_id" name="service">
                            <option value=""></option>
                            @foreach ($services as $value => $label)
                                <option value="{{ $value }}"{{ $value == request('service') ? ' selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <div class="form-group">
                            {{-- <button type="submit" class="btn btn-search">Искать</button> --}}
                            <a href="?" class="btn btn-clear">{{trans('filter.clear')}}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </form>

    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-7">
                @foreach($clinics as $key => $clinic)
                    <div class="strip_list wow fadeIn">
                        <figure>
                            <a href="{{ route('clinics.show', $clinic) }}"><img src="{{ $clinic->main_photo_id ? $clinic->mainPhoto->fileThumbnail : 'http://via.placeholder.com/565x565.jpg' }}" alt=""></a>
                        </figure>
                        @php($parentRegion = $clinic->region)
                        @while(true)
                            @if(!$parentRegion)
                                @break
                            @endif
                            <small>{{ $parentRegion->name }}</small>
                            @php($parentRegion = $parentRegion->parent)
                        @endwhile
                        <h3><a href="{{ route('clinics.show', $clinic) }}">{{ $clinic->name }}</a> </h3>
                        <p>{!! $clinic->description !!}</p>
                        <ul>
                            {{-- <li><a href="https://www.openstreetmap.org/#map=12/41.3111/69.2406" onclick="onHtmlClick('Doctors', {{ $key }})" class="btn_listing" target="_blank">View on Map</a></li> --}}
                            <li><a href="{{ route('map', $clinic) }}" class="btn_listing" target="_blank">{{trans('doctors.view_on_map')}}</a></li>
                            <li><a href="{{ route('clinics.show', $clinic) }}">{{trans('doctors.in_detail')}}</a></li>
                        </ul>
                   
                    </div> 
                      
                @endforeach

                <nav aria-label="" class="add_top_22">
                    <ul class="pagination pagination-sm">
                        {{ $clinics->links() }}
                    </ul>
                </nav>
            </div>

            <aside class="col-lg-5" id="sidebar">
                <div id="map_listing" class="normal_list">
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
                             <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
                       
                       <style>
                           #map { height: 550px; width: 599px; }
                       </style>
                        <body>
                       <div id="map"></div>
                       
                    <script>
                            var map = L.map('map').setView([41.311081, 69.240562], 10);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {foo: 'bar', attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'})
                            .addTo(map);

                            var greenIcon = L.icon({
                                iconUrl: '/img/icons/location.png',
                                iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                                iconSize:     [35, 35], // size of the icon
                                popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                                    });

                                    var clinicsData = @json($clinicsJson);
                                    clinicsData = clinicsData.split('}');
                                    
                                    for(let i = 0; i < clinicsData.length; i++){
                                        clinicsData[i] = clinicsData[i].slice(1)
                                        if(clinicsData[i] != ''){
                                            clinicsData[i] = clinicsData[i].concat('}')
                                            
                                        }
                                    
                                        
                                    }
                                    removeElement(clinicsData, '');
                                    for(let i = 0; i < clinicsData.length; i++){
                                        clinicsData[i] = JSON.parse(clinicsData[i])
                                        
                                    }
                                    for(var i = 0; i < clinicsData.length; i++){
                                        
                                        
                                            let newArray = clinicsData[i].location.split(',');
                                            for(let a = 0; a < newArray.length; a++){
                                                newArray[a] = parseFloat(newArray[a]);
                                            }
                                           
                                            clinicsData[i].location = newArray;
                                            
                                        
                                     
                                    }
                                    for(var i = 0; i < clinicsData.length; i++){
                                           
                                            L.marker(clinicsData[i].location,{icon:greenIcon}).addTo(map).bindPopup(clinicsData[i].clinicName);   
                                    }

                                    function removeElement(array, elem) {
                                        var index = array.indexOf(elem);
                                        if (index > -1) {
                                            array.splice(index, 1);
                                        }
                                    }
                                  
                            </script>
                           </body>
                </div>
            </aside>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{asset('vendor/select2/js/select2.min.js')}}"></script>
<script>
    $('#region_id').select2();
    $('#service_id').select2();
</script>
@endsection
