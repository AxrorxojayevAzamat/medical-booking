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
                                    <a href="/doctors">Doctor</a>
                                </li>
                                <li style="margin: auto 10px;">
                                    <a href="/clinics">Clinic</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="search_bar_list">
                                <input type="text" class="form-control" placeholder="Ex. Specialist, Name, Doctor...">
                                <input type="submit" value="Search">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="filters_listing">
                <div class="container">
                    <form action="?" method="GET">
                        <ul class="clearfix row d-flex justify-content-center">
                            <li class="first">
                                <h6>Поиск по названии...</h6>
                                <div class="form-group">
                                    <input class="form-control" name="name" type="search" placeholder="Название" aria-label="Search" value="{{ request('name') }}">
                                </div>
                            </li>
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
                                <div class="form-group">
                                    <button type="submit" class="btn btn-search">Искать</button>
                                    <a href="?" class="btn btn-clear">Очистить</a>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>

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
                                    <li><a href="#0" onclick="initMap(41.2646, 69.2163)" class="btn_listing">Показать на карте</a></li>
                                    <li><a href="{{ route('clinics.show', $clinic) }}">Подробно</a></li>
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
        </main>
    </div>
@endsection

@section('scripts')
    <script>
        $('#region_id').select2();
    </script>
@endsection
@section('css')
    <style>
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
    border-radius: 0
}

.filters_listing li .select2-selection {
    min-height: 40px;
}

.filters_listing li .select2-selection__arrow {
    min-height: 40px;
}

.filters_listing li .form-group span.select2-container--default {
    width: 100%;
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
    color: #fff;
    border: 2px solid #e74e84;
    background-color: #e74e84;
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
