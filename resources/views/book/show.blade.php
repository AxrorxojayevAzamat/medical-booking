@extends('layouts.app')

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
                        @foreach($user->specializations()->pluck('name_ru') as $value)
                        <small>
                            {{ $loop->first ? '' : ', ' }}
                            {{$value}}
                        </small>
                        @endforeach
                        <h1>{{$user->profile ? $user->profile->fullName : ''}}</h1>
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
                    @foreach($clinics as $clinicKey => $clinicValue)

                        @guest
                        <form method="GET" action="{{ route('patient.booking', [$user, $clinicValue]) }}" >
                        @endguest

                        @can('patient-panel')
                        <form method="GET" action="{{ route('patient.booking', [$user, $clinicValue]) }}" >
                        @endcan

                        @can('admin-panel')
                        <form method="GET" action="{{ route('admin.call-center.booking', [$user, $clinicValue]) }}" >
                        @endcan

                            <div class="box_general_2 add_bottom_45">
                                <div class="main_title_4">
                                    <h3><i class="icon_circle-slelected"></i>{{ __('Выберите дату и время') }}</h3>

                                </div>
                                <h3>{{$clinicValue->name_ru }}</h3>
                                <div class="row add_bottom_45">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <div id="calendar{{$clinicKey}}"></div>
                                        <input type="hidden" id="my_hidden_input{{$clinicKey}}" name="calendar">
                                            <ul class="legend">
                                                <li><strong></strong>{{ __('Доступный') }}</li>
                                                <li><strong></strong>{{ __('Недоступен') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <ul class="time_select version_2 add_top_20" id="radio_times{{$clinicKey}}">

                                        </ul>
                                    </div>
                                </div>
                                <!-- /row -->


                                <hr>
                                <div class="text-center"><button class="btn_1 medium" type="submit">{{ __('Забронируйте сейчас') }}</button></div>
                            </div>
                            <!-- /box_general -->
                        </form>
                        @endforeach

                        <div class="tabs_styled_2">
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
                                        <p>{{$user->profile ? $user->profile->about_ru : ''}}</p>
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
@section('scripts')
<script>
    let timetable = @json($doctorTimetables);
    let books = @json($doctorBooks);
    let holidays = @json($holidays);
    // console.log(daysOff);
    // console.log(clinics);
    console.log(timetable);
    console.log(books);
    console.log(holidays);



    var timeStart = [];
    var timeEnd = [];
    var time_slots = [[], []];

    var disabledDates = [[], []];
    var disabledDays = [[], []];
    var disDays = [[], []];

    function getDates(index) {
        var d = new Date();
        var year = d.getFullYear();
        var month = d.getMonth() + 1;
        var i;
        if (timetable[index].odd_start == null && timetable[index].odd_end == null) {
            i = 1;
            while (i < 30) {
                i = i + 2;
                disDays[index] = [...disDays[index], year + '-' + month + '-' + i, year + '-' + (month + 1) + '-' + i];
            }
        } else if (timetable[index].even_start == null && timetable[index].even_end == null) {
            i = 0;
            while (i < 30) {
                i = i + 2;
                disDays[index] = [...disDays[index], year + '-' + month + '-' + i, year + '-' + (month + 1) + '-' + i];
            }
        } else {
            disDays[index] = [];
        }
        return disDays[index];
    }

    function setTimes(selected_day, index) {
        var day;
        if (timetable[index].schedule_type == 1) {
            day = selected_day.getDay();

           timeStart[index] = [day == 0 ? timetable[index].sunday_start || '':
                               day == 1 ? timetable[index].monday_start || '':
                               day == 2 ? timetable[index].tuesday_start || '':
                               day == 3 ? timetable[index].wednesday_start || '':
                               day == 4 ? timetable[index].thursday_start || '':
                               day == 5 ? timetable[index].friday_start || '':
                               day == 6 ? timetable[index].saturday_start || '' : null];

           timeEnd[index] = [day == 0 ? timetable[index].sunday_end || '':
                             day == 1 ? timetable[index].monday_end || '':
                             day == 2 ? timetable[index].tuesday_end || '':
                             day == 3 ? timetable[index].wednesday_end || '':
                             day == 4 ? timetable[index].thursday_end || '':
                             day == 5 ? timetable[index].friday_end || '':
                             day == 6 ? timetable[index].saturday_end || '' : null];
                            //  console.log(timeStart[index]);
                            //  console.log(timeEnd[index]);
        } else {
            day = selected_day.getDate();

            timeStart[index] = [day % 2 != 0 ? timetable[index].odd_start || '' :
                        day % 2 == 0 ? timetable[index].even_start || '' : null];

            timeEnd[index] = [day % 2 != 0 ? timetable[index].odd_end || '':
                             day % 2 == 0 ? timetable[index].even_end || '' : null];
                            //  console.log(timeStart[index]);
                            //  console.log(timeEnd[index]);
         }
    }

    function makeInterval(day, time_start, time_end, interval, lunch_start, lunch_end, index) {
        var timeStart = new Date(day + " " + time_start);
        var timeEnd = new Date(day + " " + time_end);
        time_slots[index] = [];
        if (lunch_start && lunch_end) {
            var lunchStart = new Date(day + " " + lunch_start);
            var lunchEnd = new Date(day + " " + lunch_end);
            while (timeStart < lunchStart) {
                time_slots[index] = [...time_slots[index], (timeStart.getHours() < 10 ? '0' + timeStart.getHours() : timeStart.getHours()) + ":" +
                            (timeStart.getMinutes() < 10 ? '0' + timeStart.getMinutes() : timeStart.getMinutes())];
                timeStart.setMinutes(timeStart.getMinutes() + interval);
            }
            while (lunchEnd < timeEnd) {
                time_slots[index] = [...time_slots[index], (lunchEnd.getHours() < 10 ? '0' + lunchEnd.getHours() : lunchEnd.getHours()) + ":" +
                            (lunchEnd.getMinutes() < 10 ? '0' + lunchEnd.getMinutes() : lunchEnd.getMinutes())];
                lunchEnd.setMinutes(lunchEnd.getMinutes() + interval);
            }
        } else {
            while (timeStart < timeEnd) {
                time_slots[index] = [...time_slots[index], (timeStart.getHours() < 10 ? '0' + timeStart.getHours() : timeStart.getHours()) + ":" +
                            (timeStart.getMinutes() < 10 ? '0' + timeStart.getMinutes() : timeStart.getMinutes())];
                timeStart.setMinutes(timeStart.getMinutes() + interval);
            }
        }
        // console.log(time_slots[index]);
    }

    function appendRadioButton(time_slot, book, day, index) {
        var equeled;
        $("#radio_times" + index).empty();
        for (var i = 0; i < time_slot[index].length; i++) {
            equeled = true;
            for (var j = 0; j < book.length; j++) {
                if ((time_slot[index][i] == book[j].time_start.slice(0, 5)) && (day == book[j].booking_date) && (timetable[index].clinic_id == book[j].clinic_id)) {
                    equeled = false;
                    $("#radio_times" + index).append(
                        '<li><input type="radio" id="radio' + index + '-' + i + '" name="radio_time" value="' +
                            time_slot[index][i] +'"><label style="color: #ccc; text-decoration: line-through;">' + time_slot[index][i] + '</label></li>'
                    );
                    break;
                }
            }
            if(equeled)
            $("#radio_times" + index).append(
                    '<li><input type="radio" id="radio' + index + '-' + i + '" name="radio_time" value="' +
                        time_slot[index][i] + '"><label for="radio' + index + '-' + i + '">'+ time_slot[index][i] + '</label></li>'
                )
        }
    }
    var blabla = null;

        // timetable[1].tuesday_start = null;
        // timetable[1].tuesday_end = null;

    for (var i = 0; i < timetable.length; i++) {

        disabledDates[i] = timetable[i].schedule_type == 2 ? getDates(i) : [];
        disabledDays[i] = timetable[i].schedule_type == 1 ? [timetable[i].sunday_start == null ? 0 : '',
            timetable[i].monday_start == null ? 1 : '',
            timetable[i].tuesday_start == null ? 2 : '',
            timetable[i].wednesday_start == null ? 3 : '',
            timetable[i].thursday_start == null ? 4 : '',
            timetable[i].friday_start == null ? 5 : '',
            timetable[i].saturday_start == null ? 6 : ''] : [];

        $('#calendar' + i).datepicker({
            todayHighlight: true,
            daysOfWeekDisabled: disabledDays[i],
            weekStart: 1,
            format: "yyyy-mm-dd",
            datesDisabled: disabledDates[i].concat(holidays),
        }).on('changeDate', function (e) {
            $('#my_hidden_input' + e.currentTarget.id.slice(-1)).val(e.format());
            setTimes((new Date(e.format())),  e.currentTarget.id.slice(-1));
            makeInterval(e.format(), timeStart[e.currentTarget.id.slice(-1)], timeEnd[e.currentTarget.id.slice(-1)],
                    timetable[e.currentTarget.id.slice(-1)].interval, timetable[e.currentTarget.id.slice(-1)].lunch_start,
                    timetable[e.currentTarget.id.slice(-1)].lunch_end, e.currentTarget.id.slice(-1));
            appendRadioButton(time_slots, books, e.format(), e.currentTarget.id.slice(-1));
        });
    }
    $(document).ready(function () {
        var d = new Date();
        var today = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();
        for (var i = 0; i < timetable.length; i++) {
            setTimes(d, i);
            makeInterval(today, timeStart[i], timeEnd[i], timetable[i].interval,
                    timetable[i].lunch_start, timetable[i].lunch_end, i);
            appendRadioButton(time_slots, books, today, i);
            if(time_slots[i][0] == "00:00") {
                $("#radio_times" + i).empty();
            }
        }
    });

</script>

@endsection
