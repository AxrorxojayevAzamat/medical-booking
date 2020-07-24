@extends('layouts.app')

@section('breadcrumbs', '')

@section('content')
    <div class="hero_home version_1">
        <div class="content">
            <h3>{{ trans('msg.wlcm') }}</h3>
            <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
            <form method="GET" id="main-form">
                <div id="custom-search-input">
                    <div class="input-group">
                        <input type="text" id="main-form-text" class="search-query" placeholder="Название, Имя ....">
                        <input type="submit" id="main-search-button" class="btn_search" value="Search">
                    </div>
                    <ul>
                        <li>
                            <input type="radio" id="doctor-radio" name="radio_search" value="doctor" checked>
                            <label for="doctor-radio">Докторы</label>
                        </li>
                        <li>
                            <input type="radio" id="clinic-radio" name="radio_search" value="clinic">
                            <label for="clinic-radio">Клиники</label>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>

    <div class="container margin_120_95">
        <div class="main_title">
            <h2>Discover the <strong>online</strong> appointment!</h2>
            <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie. Sed ad debet scaevola, ne mel.</p>
        </div>
        <div class="row add_bottom_30">
            <div class="col-lg-4">
                <div class="box_feat" id="icon_1">
                    <span></span>
                    <h3>Find a Doctor</h3>
                    <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box_feat" id="icon_2">
                    <span></span>
                    <h3>View profile</h3>
                    <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box_feat" id="icon_3">
                    <h3>Book a visit</h3>
                    <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
                </div>
            </div>
        </div>
        <p class="text-center"><a href="{{ route('doctors.index' ) }}" class="btn_1 medium">Find Doctor</a></p>
    </div>

    <div class="bg_color_1">
        <div class="container margin_120_95">
            <div class="main_title">
                <h2>Докторы с высшим рейтингом</h2>
                <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri.</p>
            </div>

            <div id="reccomended" class="owl-carousel owl-theme">
                @foreach($bestRatedDoctors as $doctor)
                    <div class="item">
                        <a href="{{ route('doctors.show', $doctor) }}">
                            <div class="views"><i class="icon-eye-7"></i>{{ $doctor->profile->rate }}</div>
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
            <h2>Найти доктора или клинику</h2>
            <p>Nec graeci sadipscing disputationi ne, mea ea nonumes percipitur. Nonumy ponderum oporteat cu mel, pro movet cetero at.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="list_home">
                    <div class="list_title">
                        <i class="icon_pin_alt"></i>
                        <h3>Искать по региону</h3>
                    </div>
                    <ul>
                        @foreach($regions as $region)
                            <li><a href="{{ route('doctors.index') . '?region=' . $region->id }}"><strong>23</strong>{{ $region->name }}</a></li>
                        @endforeach
                        <li><a href="{{ route('doctors.index') }}">Больше...</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="list_home">
                    <div class="list_title">
                        <i class="icon_archive_alt"></i>
                        <h3>Искать по специализации</h3>
                    </div>
                    <ul>
                        @foreach($specializations as $specialization)
                            <li>
                                <a href="{{ route('doctors.index') . '?specialization=' . $specialization->id }}">
                                    <strong>{{ $specialization->doctors()->count() }}</strong>{{ $specialization->name }}
                                </a>
                            </li>
                        @endforeach
                        <li><a href="{{ route('doctors.index') }}">Больше....</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="app_section">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-5">
                    <p><img src="img/app_img.svg" alt="" class="img-fluid" width="500" height="433"></p>
                </div>
                <div class="col-md-6">
                    <small>Application</small>
                    <h3>Download <strong>Findoctor App</strong> Now!</h3>
                    <p class="lead">Tota omittantur necessitatibus mei ei. Quo paulo perfecto eu, errem percipit
                        ponderum no eos. Has eu mazim sensibus. Ad nonumes dissentiunt qui, ei menandri electram
                        eos. Nam iisque consequuntur cu.</p>
                    <div class="app_buttons wow" data-wow-offset="100">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43.1 85.9"
                             style="enable-background:new 0 0 43.1 85.9;" xml:space="preserve">
            <path stroke-linecap="round" stroke-linejoin="round" class="st0 draw-arrow"
                  d="M11.3,2.5c-5.8,5-8.7,12.7-9,20.3s2,15.1,5.3,22c6.7,14,18,25.8,31.7,33.1"/>
                            <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-1"
                                  d="M40.6,78.1C39,71.3,37.2,64.6,35.2,58"/>
                            <path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-2"
                                  d="M39.8,78.5c-7.2,1.7-14.3,3.3-21.5,4.9"/>
          </svg>
                        <a href="#0" class="fadeIn"><img src="img/apple_app.png" alt="" width="150" height="50"
                                                         data-retina="true"></a>
                        <a href="#0" class="fadeIn"><img src="img/google_play_app.png" alt="" width="150"
                                                         height="50" data-retina="true"></a>
                    </div>
                </div>
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
