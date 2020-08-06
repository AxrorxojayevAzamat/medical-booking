@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/clinics_filter.css') }}" rel="stylesheet">
@endsection

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
                                <a href="{{ route('doctors.index') }}">{{ trans('menu.doctors') }}</a>
                            </li>
                            <li class="{{ Request::is('clinics*') ? 'active' : '' }}" style="margin: auto 10px;">
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
                        <h3>{{ $clinic->name }}</h3>
                        <p>{{ $clinic->description }}</p>
                        <ul>
                            {{-- <li><a href="#0" onclick="onHtmlClick('Doctors', {{ $key }})" class="btn_listing">View on Map</a></li> --}}
                        <li><a href="#0" onclick="initMap(41.2646, 69.2163)" class="btn_listing">{{trans('doctors.view_on_map')}}</a></li>
                            <li><a href="{{ route('clinics.show', $clinic) }}">{{trans('doctors.in_detail')}}</a></li>
                        </ul>
                    </div>
                @endforeach

                <nav aria-label="" class="add_top_20">
                    <ul class="pagination pagination-sm">
                        {{ $clinics->links() }}
                    </ul>
                </nav>
            </div>

            <aside class="col-lg-5" id="sidebar">
                <div id="map_listing" class="normal_list">
                </div>
            </aside>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#region_id').select2();
        $('#service_id').select2();
    </script>
@endsection
