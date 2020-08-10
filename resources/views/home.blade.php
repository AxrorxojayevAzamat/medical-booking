@extends('layouts.app')

@section('breadcrumbs', '')

@section('content')
    <div class="hero_home version_1">
        <div class="content">
            <h3>{{ trans('msg.wlcm') }}</h3>
            <p>{{ trans('extra_info.find_doctor_info') }}</p>
            <form method="GET" id="main-form">
                <div id="custom-search-input">
                    <div class="input-group">
                        <input type="text" id="main-form-text" class="search-query" placeholder="{{ trans('home.name_name' ) }}">
                    <input type="submit" id="main-search-button" class="btn_search" value="{{trans('msg.search')}}">
                    </div>
                    <ul>
                        <li>
                            <input type="radio" id="doctor-radio" name="radio_search" value="doctor" checked>
                        <label for="doctor-radio">{{trans('menu.doctors')}}</label>
                        </li>
                        <li>
                            <input type="radio" id="clinic-radio" name="radio_search" value="clinic">
                            <label for="clinic-radio">{{trans('menu.clinics')}}</label>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>

    <div class="container margin_120_95">
        <div class="main_title">
            <h2>{{ trans('home.search_by_route' ) }}</h2>
        </div>
        <div class="row add_bottom_30">
            @foreach($services as $service)
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('clinics.index') . '?service=' .  $service->id }}" class="box_cat_home">
                        <i class="icon-info-4"></i>
                        <img src="{{ $service->icon ? $service->iconOriginal : 'img/icon_cat_1.svg' }}" width="60" height="60" alt="">
                        <h3>{{ $service->name }}</h3>
                        <ul class="clearfix" id="abcd">
                            <li><strong>{{ $service->serviceClinics()->count() }}</strong>{{trans('doctors.university')}}</li>
                        </ul>
                    </a>
                </div>
            @endforeach
        </div>
        <p class="text-center"><a href="{{ route('clinics.index' ) }}" class="btn_1 medium">{{trans('home.more')}}</a></p>
    </div>

    <div class="bg_color_1">
        <div class="container margin_120_95">
            <div class="main_title">
                <h2>{{ trans('home.top_rate_doctors' ) }}</h2>
                <p>{{ trans('extra_info.rate_top_doctors' ) }}</p>
            </div>

            <div id="reccomended" class="owl-carousel owl-theme">
                @foreach($bestRatedDoctors as $doctor)
                    <div class="item">
                        <a href="{{ route('doctors.show', $doctor) }}">
                            <div class="views"><i class="icon-star-5"></i>{{ $doctor->profile->rate }}</div>
                            <div class="title">
                                <h4>{{ $doctor->profile->fullName }}
                                    <em>
                                        @foreach($doctor->specializations as $specialization)
                                            {{ $specialization->name }}<br>
                                        @endforeach
                                    </em>
                                </h4>
                            </div>
                            <img src="{{ $doctor->profile->avatar ? $doctor->profile->image : 'img/no-avatar.jpg' }}" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container margin_120_95">
        <div class="main_title">
            <h2>{{ trans('home.find_doctors_or_clinics' ) }}</h2>
            <p>{{ trans('extra_info.doctor_or_clinic' ) }}</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="list_home">
                    <div class="list_title">
                        <i class="icon_pin_alt"></i>
                        <h3>{{ trans('home.search_by_region' ) }}</h3>
                    </div>
                    <ul>
                        @foreach($regions as $region)
                            <li><a href="{{ route('doctors.index') . '?region=' . $region->id }}"><strong>23</strong>{{ $region->name }}</a></li>
                        @endforeach
                        <li><a href="{{ route('doctors.index') }}">{{ trans('home.more' ) }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="list_home">
                    <div class="list_title">
                        <i class="icon_archive_alt"></i>
                        <h3>{{ trans('home.search_by_specialization' ) }}</h3>
                    </div>
                    <ul>
                        @foreach($specializations as $specialization)
                            <li>
                                <a href="{{ route('doctors.index') . '?specialization=' . $specialization->id }}">
                                    <strong>{{ $specialization->doctors()->count() }}</strong>{{ $specialization->name }}
                                </a>
                            </li>
                        @endforeach
                        <li><a href="{{ route('doctors.index') }}">{{ trans('home.more' ) }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="bg_color_1">--}}
{{--        --}}
{{--    </div>--}}

    <div id="app_section">
        <div class="container">
            <div class="row justify-content-around">
                <div class="main_title_5">
                    <h2>{{ trans('home.discover_the_appointment' ) }}</h2>
                    <p>{{ trans('extra_info.online_meeting' ) }}</p>
                </div>
                <div class="row add_bottom_30">
                    <div class="col-lg-4">
                        <div class="box_feat" id="icon_1">
                            <span></span>
                            <h3>{{ trans('home.find_doctor' ) }}</h3>
                            <p>{{ trans('extra_info.extra1' ) }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box_feat" id="icon_2">
                            <span></span>
                            <h3>{{ trans('home.view_profile' ) }}</h3>
                            <p>{{ trans('extra_info.extra2' ) }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box_feat" id="icon_3">
                            <h3>{{ trans('home.book_visit' ) }}</h3>
                            <p>{{ trans('extra_info.extra3' ) }}</p>
                        </div>
                    </div>
                </div>
                <p class="text-center"><a href="{{ route('doctors.index' ) }}" class="btn_1 medium">{{ trans('home.find_doctor' ) }}</a></p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="application/javascript">
        let mainSearchButton = $('#main-search-button');
        let doctorRadioSearch = $('#doctor-radio');
        let clinicRadioSearch = $('#clinic-radio');
        let mainForm = $('#main-form');
        let mainFormText = $('#main-form-text');

        $(document).ready(function () {
            mainSearchButton.click(function (e) {
                e.preventDefault();

                if (doctorRadioSearch.is(':checked')) {
                    console.log('Doctor Button is pressed!!!');
                    mainFormText.attr('name', 'full_name')
                    mainForm.attr('action', '{{ route('doctors.index') }}').submit();
                } else {
                    console.log('Clinic Button is pressed!!!');
                    mainFormText.attr('name', 'name')
                    mainForm.attr('action', '{{ route('clinics.index') }}').submit();
                }
            });
        });
    </script>
@endsection
