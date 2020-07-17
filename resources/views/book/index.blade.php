@extends('layouts.app')

@section('content')

<div id="page">
    <main class="theia-exception">
        <div id="results">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h4>{!! trans('doctors.showing_results', ['current' => $countCurrent, 'all' => $countAll]) !!}</h4>
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
                    <ul class="clearfix">
                        <li>
                            <h6>Layout</h6>
                            <div class="layout_view">
                                <a href="grid-list.html"><i class="icon-th"></i></a>
                                <a href="#0" class="active"><i class="icon-th-list"></i></a>
                                <a href="list-map.html"><i class="icon-map-1"></i></a>
                            </div>
                        </li>
                        <li>
                            <h6>Поиск по имени...</h6>
                            <div class="form-group">
                                <input class="form-control" name="full_name" type="search" placeholder="ФИО" aria-label="Search" value="{{ request('full_name') }}">
                            </div>
                        </li>
                        <li>
                            <h6>Поиск по названии клиники...</h6>
                            <div class="form-group">
                                <select id="clinic_id" name="clinic">
                                    <option value=""></option>
                                    @foreach ($clinics as $value => $label)
                                        <option value="{{ $value }}"{{ $value == request('clinic') ? ' selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Искать</button>
                                <a href="?" class="btn btn-outline-secondary">Очистить</a>
                            </div>
                        </li>
                        <li>
                            <h6>Сортировка по</h6>
                            <select name="order_by" class="selectbox" multiple>
                                <option value=""></option>
                                <option value="alphabet"{{ 'alphabet' == request('order_by') ? ' selected' : '' }}>Алфавиту</option>
                                <option value="best_rated"{{ 'best_rated' == request('order_by') ? ' selected' : '' }}>Рейтингу</option>
                            </select>
                        </li>
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
                            <a href="detail-page.html"><img src="http://via.placeholder.com/565x565.jpg" alt=""></a>
                        </figure>
                        @foreach($doctorValue->specializations as $spec)
                        <small>{{$spec->name_uz}}</small>
                        @endforeach
                        <h3>{{$doctorValue->profile ? $doctorValue->profile->fullName : ''}}</h3>
                        <p>{{$doctorValue->profile ? $doctorValue->profile->about_ru : ''}}</p>
                        <span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i> <small>(145)</small></span>
                        <a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="img/badges/badge_1.svg" width="15" height="15" alt=""></a>
                        <ul>
                            {{-- <li><a href="#0" onclick="onHtmlClick('Doctors', {{ $doctorKey }})" class="btn_listing">View on Map</a></li> --}}
                            <li><a href="#0" onclick="initMap(41.2646, 69.2163)" class="btn_listing">View on Map</a></li>
                            <li><a href="{{ route('book.show',$doctorValue) }}">Book now</a></li>
                        </ul>
                    </div>
                    @endforeach
                    <!-- /strip_list -->



                    <nav aria-label="" class="add_top_20">
                        <ul class="pagination pagination-sm">
                            {{ $doctors->links() }}
                        </ul>
                    </nav>
                    <!-- /pagination -->
                </div>
                <!-- /col -->

                <aside class="col-lg-5" id="sidebar">
                    <div id="map_listing" class="normal_list">
                    </div>
                </aside>
                <!-- /aside -->

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!-- /main -->


</div>
@endsection

@section('scripts')
    <script>
        $('#region_id').select2();
        $('#clinic_id').select2();
        $('#specialization_id').select2();
    </script>
@endsection
