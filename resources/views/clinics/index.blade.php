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
                    </li>
                    <li>
                        <h6>{{trans('filter.search_regions')}}</h6>
                        <select id="region_id" name="region">
                            <option value=""></option>
                            @foreach ($regions as $value => $label)
                                <option value="{{ $value }}"{{ $value == request('region') ? ' selected' : '' }}>{{ $label }}</option>
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
    </script>
@endsection
@section('css')
    <style>
#region_id {
    width: 300px !important;
}
.filters_listing {
    background-color: #3f4079;
}

.filters_listing ul li {
    margin-right: 10px;
}

.filters_listing li .sbHolder {
    min-height: 40px;
    border-radius: 0;
}

.filters_listing ul li h6 {
    color: #fff;
    margin-bottom: 3px;
}

.filters_listing li .sbHolder .sbToggle {
    line-height: 40px;
}

.filters_listing li .sbHolder .sbSelector {
    line-height: 40px;
}

.filters_listing ul li .form-group .form-control {
    border-radius: 3px 0 0 3px;
}

.filters_listing li .select2 .select2-selection__rendered {
    line-height: 40px;
}
.filters_listing .select2-container--default .select2-selection--single {
    border-radius: 3px 0 0 3px;
}

.filters_listing li .select2-selection {
    min-height: 40px;
}

.filters_listing li .select2-selection__arrow {
    min-height: 40px;
}

.filters_listing li .form-group span.select2-container--default {
    width: 270px!important;
    border-radius: 3px 0 0 3px;

}
.filters_listing ul li:nth-child(3) .btn-search {
    min-height: 40px;
    background-color: #74d1c6;
    border-color: #74d1c6;
    font-weight: 600;
    transition: all 0.3s ease-in-out;
    border-radius: 0;
    color: #fff
    /* margin-right: 7px; */

}

.filters_listing ul li:nth-child(3) .btn-search:hover {
    background-color: #e74e84;
    border-color: #e74e84;
}

.filters_listing ul li:nth-child(3) .btn-clear {
    min-height: 40px;
    font-weight: 600;
    color: #3f4079;
    border: 2px solid #3f4079;
    background-color: #fff;
    font-weight: 600;
    transition: all 0.3s ease-in-out;
    border-radius: 0 3px 3px 0;
}

.filters_listing ul li:nth-child(3) .btn-clear:hover {
    color: #fff;
    background-color: #74d1c6;
    border-color: #74d1c6;
}

.filters_listing ul li:nth-child(3) .form-group {
    margin-left: 10px;
    margin-top: 16px;
}

    </style>
@endsection
