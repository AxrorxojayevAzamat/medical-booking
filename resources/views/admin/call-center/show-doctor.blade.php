@extends('layouts.admin.page')

@section('content')
<div id="page">
    <main>
        <div class="container margin_60">

            <div class="row">
                <aside class="col-xl-3 col-lg-4" id="sidebar">
                    <div class="box_profile">
                        <figure>
                            <img src="http://via.placeholder.com/565x565.jpg" alt="" class="img-fluid">
                        </figure>
                        @foreach($doctor->specializations()->pluck('name_ru') as $value)
                        <small>
                            {{ $loop->first ? '' : ', ' }}
                            {{$value}}
                        </small>
                        @endforeach
                        <h1>{{$doctor->profile ? $doctor->profile->fullName : ''}}</h1>
                        <span class="rating">
                            <i class="icon_star voted"></i>
                            <i class="icon_star voted"></i>
                            <i class="icon_star voted"></i>
                            <i class="icon_star voted"></i>
                            <i class="icon_star"></i>
                            <small>(145)</small>
                            <a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="{{asset('img/badges/badge_1.svg')}}" width="15" height="15" alt=""></a>
                        </span>
                        <ul class="statistic">
                            <li>854 {{ trans('Просмотры') }}</li>
                            <li>124 {{ trans('Пациенты') }}</li>
                        </ul>
                        @foreach($clinics as $clinic)
                        <ul class="contacts">
                            <li><h6>{{ trans('Название клиники') }}</h6>{{$clinic->name_ru}}</li>
                            <li><h6>{{ trans('Адрес клиники') }}</h6>{{$clinic->address_ru}}</li>
                            <li><h6>{{ trans('Телефон клиники') }}</h6><a href="tel://{{$clinic->phone_numbers}}">{{$clinic->phone_numbers}}</a></li>
                        </ul>
                        {{-- <div class="text-center"><a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x0:0xa6a9af76b1e2d899!2sAssistance+%E2%80%93+H%C3%B4pitaux+De+Paris!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" class="btn_1 outline" target="_blank"><i class="icon_pin"></i> View on map</a></div> --}}
                        <div class="text-center"><a href="https://www.google.com/maps/dir/41.3218984,69.2096464/@41.3184591,69.2052458,16.5z/data=!4m2!4m1!3e3" class="btn_1 outline" target="_blank"><i class="icon_pin"></i> View on map</a></div>
                        @endforeach
                    </div>
                </aside>
                <!-- /asdide -->

                <div class="col-xl-9 col-lg-8">
                    @foreach($clinics as $key => $clinic)

                    <form method="POST" action="{{ route('admin.call-center.booking-doctor') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="box_general_2 add_bottom_45">
                            <div class="main_title_4">
                                <h3><i class="icon_circle-slelected"></i>{{ __('Выберите дату и время') }}</h3>

                            </div>
                            <h3>{{$clinic->name_ru }}</h3>

                            @include('book.calendar-time')

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('book.description') }}</label>
                                    <textarea class="form-control" name="description"  id="description"  required rows="3"></textarea>
                                </div>
                            </div>
                            <hr>
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
                            <input type="hidden" name="clinic_id" value="{{$clinic->id}}">
                            <input type="hidden" name="amount" value="{{$price}}">
                            <input type="checkbox" class="time_checkbox{{$key}}" style="display: none" required>
                            <div class="choose" >
                                <div class="form-group">
                                    <label>{{ trans('book.choose_one_of_them') }}</label>
                                </div>

                                <div class="row d-flex justify-content-center">

                                    <div class="form-group">
                                        <input type="radio" name="payment_type" value="{{\App\Entity\Book\Book::PAYME}}" checked="checked" />
                                        <img src="{{asset('img/payme_01.svg')}}" class="img-payme-click choose-payme" width="200px" height=80px>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name="payment_type" value="{{\App\Entity\Book\Book::CLICK}}" />
                                        <img src="{{asset('img/click_01.jpg')}}" class="img-payme-click choose-click" width="200px" height="80px">
                                    </div>
                                </div>
                                <div class="error-container">
                                </div>

                            </div>

                            <hr>

                            <div class="text-center"><button class="btn_1 medium" id="{{$key}}" onclick="checkDay(event)" type="submit">{{ __('Забронируйте сейчас') }}</button></div>
                        </div>
                        <!-- /box_general -->
                    </form>
                    @endforeach

                    <div class="tabs_sty    led_2">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-expanded="true">Общая информация</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews">Отзывы</a>
                            </li>
                        </ul>
                        <!--/nav-tabs -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                                <div class="indent_title_in">
                                    <i class="pe-7s-user"></i>
                                    <h3>{{ trans('Профессиональные заявления')}}</h3>
                                    <p>Mussum ipsum cacilds, vidis litro abertis.</p>
                                </div>
                                <div class="wrapper_indent">
                                    <p>{{$doctor->profile ? $doctor->profile->about_ru : ''}}</p>
                                    <h6>{{ trans('Специализации')}}</h6>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul class="bullets">
                                                @foreach ($specs as $spec)
                                                <li> {{$spec->name_ru}}
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>
                                    <!-- /row-->
                                </div>
                                <!-- /wrapper indent -->

                            </div>
                            <!-- /tab_2 -->

                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="reviews-container">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div id="review_summary">
                                                <strong>4.7</strong>
                                                <div class="rating">
                                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                                </div>
                                                <small>Based on 4 reviews</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-10 col-9">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-3"><small><strong>5 stars</strong></small></div>
                                            </div>
                                            <!-- /row -->
                                            <div class="row">
                                                <div class="col-lg-10 col-9">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-3"><small><strong>4 stars</strong></small></div>
                                            </div>
                                            <!-- /row -->
                                            <div class="row">
                                                <div class="col-lg-10 col-9">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-3"><small><strong>3 stars</strong></small></div>
                                            </div>
                                            <!-- /row -->
                                            <div class="row">
                                                <div class="col-lg-10 col-9">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-3"><small><strong>2 stars</strong></small></div>
                                            </div>
                                            <!-- /row -->
                                            <div class="row">
                                                <div class="col-lg-10 col-9">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-3"><small><strong>1 stars</strong></small></div>
                                            </div>
                                            <!-- /row -->
                                        </div>
                                    </div>
                                    <!-- /row -->

                                    <hr>

                                    <div class="review-box clearfix">
                                        <figure class="rev-thumb"><img src="http://via.placeholder.com/150x150.jpg" alt="">
                                        </figure>
                                        <div class="rev-content">
                                            <div class="rating">
                                                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                            </div>
                                            <div class="rev-info">
                                                Admin – April 03, 2016:
                                            </div>
                                            <div class="rev-text">
                                                <p>
                                                    Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End review-box -->

                                    <div class="review-box clearfix">
                                        <figure class="rev-thumb"><img src="http://via.placeholder.com/150x150.jpg" alt="">
                                        </figure>
                                        <div class="rev-content">
                                            <div class="rating">
                                                <i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                            </div>
                                            <div class="rev-info">
                                                Ahsan – April 01, 2016
                                            </div>
                                            <div class="rev-text">
                                                <p>
                                                    Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End review-box -->

                                    <div class="review-box clearfix">
                                        <figure class="rev-thumb"><img src="http://via.placeholder.com/150x150.jpg" alt="">
                                        </figure>
                                        <div class="rev-content">
                                            <div class="rating">
                                                <i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                            </div>
                                            <div class="rev-info">
                                                Sara – March 31, 2016
                                            </div>
                                            <div class="rev-text">
                                                <p>
                                                    Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End review-box -->
                                </div>
                                <!-- End review-container -->
                                <hr>
                                <div class="text-right"><a href="submit-review.html" class="btn_1 add_bottom_15">Submit review</a></div>
                            </div>
                            <!-- /tab_3 -->
                        </div>
                        <!-- /tab-content -->
                    </div>
                    <!-- /tabs_styled -->
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!-- /main -->
</div>
<!-- page -->

<div id="toTop"></div>
<!-- Back to top button -->



@endsection

@section('js')
@include('book.calendar-time-js')
@endsection
