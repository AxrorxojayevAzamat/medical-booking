@extends('layouts.app')

@section('content')

<div id="page">
    <main class="theia-exception">
        <div id="results">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h4><strong>Showing 10</strong> of 140 results</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="search_bar_list">
                            <input type="text" class="form-control" placeholder="Ex. Specialist, Name, Doctor...">
                            <input type="submit" value="Search">
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /results -->

        <div class="filters_listing">
            <div class="container">
                <ul class="clearfix">
                    <li>
                        <h6>Type</h6>
                        <div class="switch-field">
                            <input type="radio" id="all" name="type_patient" value="all" checked>
                            <label for="all">All</label>
                            <input type="radio" id="doctors" name="type_patient" value="doctors">
                            <label for="doctors">Doctors</label>
                            <input type="radio" id="clinics" name="type_patient" value="clinics">
                            <label for="clinics">Clinics</label>
                        </div>
                    </li>
                    <li>
                        <h6>Layout</h6>
                        <div class="layout_view">
                            <a href="grid-list.html"><i class="icon-th"></i></a>
                            <a href="#0" class="active"><i class="icon-th-list"></i></a>
                            <a href="list-map.html"><i class="icon-map-1"></i></a>
                        </div>
                    </li>
                    <li>
                        <h6>Sort by</h6>
                        <select name="orderby" class="selectbox">
                            <option value="Closest">Closest</option>
                            <option value="Best rated">Best rated</option>
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                        </select>
                    </li>
                </ul>
            </div>
            <!-- /container -->
        </div>
        <!-- /filters -->

        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-7">

                    @foreach($doctors as $doctor)
                    <div class="strip_list wow fadeIn">
                        <figure>
                            <a href="detail-page.html"><img src="http://via.placeholder.com/565x565.jpg" alt=""></a>
                        </figure>
                        @foreach($doctor->specializations as $spec)
                        <small>{{$spec->name_uz}}</small>
                        @endforeach
                        <h3>{{$doctor->profile ? $doctor->profile->fullName : ''}}</h3>
                        <p>{{$doctor->profile ? $doctor->profile->about_ru : ''}}</p>
                        <span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i> <small>(145)</small></span>
                        <a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="img/badges/badge_1.svg" width="15" height="15" alt=""></a>
                        <ul>
                            <li><a href="#0" onclick="onHtmlClick('Doctors', 0)" class="btn_listing">View on Map</a></li>
                            <li><a href="{{ route('book.show',$doctor) }}">Book now</a></li>
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
