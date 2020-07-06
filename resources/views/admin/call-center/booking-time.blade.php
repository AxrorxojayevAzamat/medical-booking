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
                        <small>Primary care - Internist</small>
                        <h1>{{$user1->profile ? $user1->profile->fullName : ''}}</h1>
                        <span class="rating">
                            <i class="icon_star voted"></i>
                            <i class="icon_star voted"></i>
                            <i class="icon_star voted"></i>
                            <i class="icon_star voted"></i>
                            <i class="icon_star"></i>
                            <small>(145)</small>
                            <a href="badges.html" data-toggle="tooltip" data-placement="top" data-original-title="Badge Level" class="badge_list_1"><img src="img/badges/badge_1.svg" width="15" height="15" alt=""></a>
                        </span>
                        <ul class="statistic">
                            <li>854 {{ trans('Просмотры') }}</li>
                            <li>124 {{ trans('Пациенты') }}</li>
                        </ul>
                        <ul class="contacts">
                            <li><h6>{{ trans('Адрес клиники') }}</h6>{{$clinic1->address_ru}}</li>
                            <li><h6>{{ trans('Телефон клиники') }}</h6><a href="tel://{{$clinic1->phone_numbers}}">{{$clinic1->phone_numbers}}</a></li>
                        </ul>
                        <div class="text-center"><a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x0:0xa6a9af76b1e2d899!2sAssistance+%E2%80%93+H%C3%B4pitaux+De+Paris!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" class="btn_1 outline" target="_blank"><i class="icon_pin"></i> View on map</a></div>
                    </div>
                </aside>
                <!-- /asdide -->

                <div class="col-xl-9 col-lg-8">
                    <form method="GET" action="{{ route('admin.call-center.booking', [$user1, $clinic1]) }}" >
                        <div class="box_general_2 add_bottom_45">
                            <div class="main_title_4">
                                <h3><i class="icon_circle-slelected"></i>{{ __('Выберите дату и время') }}</h3>
                            </div>

                            <div class="row add_bottom_45">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <div id="calendar"></div>
                                        <input type="hidden" id="my_hidden_input" name="calendar">
                                        <ul class="legend">
                                            <li><strong></strong>{{ __('Доступный') }}</li>
                                            <li><strong></strong>{{ __('Недоступен') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <ul class="time_select version_2 add_top_20" id="radio_times">
                                        {{-- @foreach ($timeSlots as $value => $label)
                                        <li>
                                            <input type="radio" id="radio{{$value}}" name="radio_time" value="{{$label}}">
                                            <label for="radio{{$value}}">{{$label}}</label>
                                        </li>
                                        @endforeach --}}
                                    </ul>
                                </div>
                            </div>
                            <!-- /row -->

                            <div class="main_title_4">
                                <h3><i class="icon_circle-slelected"></i>{{ __('Выберите услугу') }}</h3>
                            </div>
                            <ul class="treatments clearfix">
                                <li>
                                    <div class="checkbox">
                                        <input type="checkbox" class="css-checkbox" id="visit1" name="visit1">
                                        <label for="visit1" class="css-label">{{ __('Визит боли в спине') }} <strong>$55</strong></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox">
                                        <input type="checkbox" class="css-checkbox" id="visit2" name="visit2">
                                        <label for="visit2" class="css-label">{{ __('Сердечно-сосудистый экран') }}<strong>$55</strong></label>
                                    </div>
                                </li>
                            </ul>
                            <hr>
                            <div class="text-center"><button class="btn_1 medium" type="submit">{{ __('Забронируйте сейчас') }}</button></div>
                        </div>
                        <!-- /box_general -->
                    </form>

                    <div class="tabs_styled_2">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-expanded="true">General info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews">Reviews</a>
                            </li>
                        </ul>
                        <!--/nav-tabs -->

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">

                                <p class="lead add_bottom_30">Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                <div class="indent_title_in">
                                    <i class="pe-7s-user"></i>
                                    <h3>{{ trans('Профессиональные заявления')}}</h3>
                                    <p>Mussum ipsum cacilds, vidis litro abertis.</p>
                                </div>
                                <div class="wrapper_indent">
                                    <p>{{$user1->profile ? $user1->profile->about_ru : ''}}</p>
                                    <h6>{{ trans('Специализации')}}</h6>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul class="bullets">
                                                @foreach ($spec1 as $spec)
                                                <li> {{$spec->name_ru}}
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-lg-6">
                                            <ul class="bullets">
                                                <li>Abdominal Radiology</li>
                                                <li>Addiction Psychiatry</li>
                                                <li>Adolescent Medicine</li>
                                                <li>Cardiothoracic Radiology </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /row-->
                                </div>
                                <!-- /wrapper indent -->

                                <hr>

                                <div class="indent_title_in">
                                    <i class="pe-7s-news-paper"></i>
                                    <h3>Education</h3>
                                    <p>Mussum ipsum cacilds, vidis litro abertis.</p>
                                </div>
                                <div class="wrapper_indent">
                                    <p>Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Nullam mollis. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapi.</p>
                                    <h6>Curriculum</h6>
                                    <ul class="list_edu">
                                        <li><strong>New York Medical College</strong> - Doctor of Medicine</li>
                                        <li><strong>Montefiore Medical Center</strong> - Residency in Internal Medicine</li>
                                        <li><strong>New York Medical College</strong> - Master Internal Medicine</li>
                                    </ul>
                                </div>
                                <!--  End wrapper indent -->

                                <hr>

                                <div class="indent_title_in">
                                    <i class="pe-7s-cash"></i>
                                    <h3>Prices &amp; Payments</h3>
                                    <p>Mussum ipsum cacilds, vidis litro abertis.</p>
                                </div>
                                <div class="wrapper_indent">
                                    <p>Zril causae ancillae sit ea. Dicam veritus mediocritatem sea ex, nec id agam eius. Te pri facete latine salutandi, scripta mediocrem et sed, cum ne mundi vulputate. Ne his sint graeco detraxit, posse exerci volutpat has in.</p>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Service - Visit</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>New patient visit</td>
                                                    <td>$34</td>
                                                </tr>
                                                <tr>
                                                    <td>General consultation</td>
                                                    <td>$60</td>
                                                </tr>
                                                <tr>
                                                    <td>Back Pain</td>
                                                    <td>$40</td>
                                                </tr>
                                                <tr>
                                                    <td>Diabetes Consultation</td>
                                                    <td>$55</td>
                                                </tr>
                                                <tr>
                                                    <td>Eating disorder</td>
                                                    <td>$60</td>
                                                </tr>
                                                <tr>
                                                    <td>Foot Pain</td>
                                                    <td>$35</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--  End wrapper_indent -->

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

@stop
@section('js')
<script>
    let daysOff = @json($daysOff);
    console.log(daysOff);

    // let timeSlots = @json($timeSlots);
    // console.log(timeSlots);

    let timetable = @json($doctorTimetable);
    console.log(timetable);

    let books = @json($doctorBooks);
    console.log(books);

    timetable.odd_start = "09:00:00";
    timetable.odd_end = "18:00:00";

    timetable.even_start = "";
    timetable.even_end = "";

    var timeStart;
    var timeEnd;
    var time_slots = [];

    var disabledDaysOfWeek = timetable.schedule_type == 1 ? [ timetable.sunday_start == null ? 0 : '',
                                                              timetable.monday_start == null ? 1 : '',
                                                              timetable.tuesday_start == null ? 2 : '',
                                                              timetable.wednesday_start == null ? 3 : '',
                                                              timetable.thursday_start == null ? 4 : '',
                                                              timetable.friday_start == null ? 5 : '',
                                                              timetable.saturday_start == null ? 6 : '' ] : [];

    // var disabledDays = timetable.schedule_type == 2 ? getDays(new Date()) : [];

    let getDays = today => {
        var disDays = [];
        return disDays;
     }

    function setTimes(selected_day) {
        var times;
        if( timetable.schedule_type == 1 ) {
            times = selected_day.getDay();

            timeStart = times == 0 ? timetable.sunday_start || '':
                        times == 1 ? timetable.monday_start || '':
                        times == 2 ? timetable.tuesday_start || '':
                        times == 3 ? timetable.wednesday_start || '':
                        times == 4 ? timetable.thursday_start || '':
                        times == 5 ? timetable.friday_start || '':
                        times == 6 ? timetable.saturday_start || '' : null;

            timeEnd = times == 0 ? timetable.sunday_end || '':
                      times == 1 ? timetable.monday_end || '':
                      times == 2 ? timetable.tuesday_end || '':
                      times == 3 ? timetable.wednesday_end || '':
                      times == 4 ? timetable.thursday_end || '':
                      times == 5 ? timetable.friday_end || '':
                      times == 6 ? timetable.saturday_end || '' : null;
        } else {
            times = selected_day.getDate();

            timeStart = times % 2 != 0 ? timetable.odd_start || '':
                        times % 2 == 0 ? timetable.even_start || '' : null;

            timeEnd = times % 2 != 0 ? timetable.odd_end || '':
                      times % 2 == 0 ? timetable.even_end || '' : null;
        }
    }

    function makeInterval(day, time_start, time_end, interval) {
        var time_sum = (new Date(day + " " + time_start)).getHours();
        var interval_sum = interval;
        var r = 0;
        time_slots = [];
        time_slots.unshift(time_sum >= 10 ? time_sum + ":00" : "0" + time_sum + ":00");

        while( (new Date(day + " " + time_end)).getHours() - 1 > time_sum ) {
            if ( interval_sum >= 60) {
                time_sum = time_sum + 1;
                r = interval_sum % 60;
                time_slots = [...time_slots, time_sum >= 10 ? time_sum + ":" + ( r >= 10 ? r : "0" + r ) :
                                             "0" + time_sum + ":" + ( r >= 10 ? r : "0" + r )];
                interval_sum = 0;
                interval_sum = r + interval;

            } else {
                time_slots = [...time_slots, time_sum >= 10 ? time_sum + ":" + ( (interval_sum >= 10) ? interval_sum : "0" + interval_sum ) :
                                             "0" + time_sum + ":" + ( (interval_sum >= 10) ? interval_sum : "0" + interval_sum )];
                interval_sum = r + interval;
            }
        }
    }

    function appendRadioButton(time_slot, book, day) {
        var equeled;
        $("#radio_times").empty();
        for(var i = 0; i < time_slot.length; i++) {
            equeled = true;
            for(var j = 0; j < book.length; j++) {
                if( (time_slot[i]+":00" == book[j].time_start) && (day == book[j].booking_date)) {
                    equeled = false;
                    $("#radio_times").append(
                        '<li><input type="radio" id="radio'+ i +'" name="radio_time" value="'+
                            time_slot[i] +'"><label style="color: #ccc; text-decoration: line-through;">'+ time_slot[i] +'</label></li>'
                    );
                    break;
                }
            }
            if(equeled)
            $("#radio_times").append(
                    '<li><input type="radio" id="radio'+ i +'" name="radio_time" value="'+
                        time_slot[i] +'"><label for="radio'+i+'">'+ time_slot[i] +'</label></li>'
                )
        }
    }

    $('#calendar').datepicker({
        todayHighlight: true,
        daysOfWeekDisabled: disabledDaysOfWeek,
        weekStart: 1,
        format: "yyyy-mm-dd",
        datesDisabled: [],
    }).on('changeDate', function (e) {
        $('#my_hidden_input').val(e.format());
        setTimes( ( new Date( e.format() ) ) );
        makeInterval(e.format(), timeStart, timeEnd, timetable.interval);
        appendRadioButton(time_slots, books, e.format());
        console.log(time_slots);
    });

</script>

@stop