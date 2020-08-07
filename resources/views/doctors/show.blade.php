@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="/css/gallery.css">
<link rel="stylesheet" type="text/css" href="/css/lightbox.gallery.min.css">
@endsection
@section('content')

    <div class="container margin_60">

        <div class="row">
            <aside class="col-xl-3 col-lg-4" id="sidebar">
                <div class="box_profile">
                    <figure>
                        @if($user->profile->image)
                            <img src="{{asset($user->profile->image)}}" alt="">
                        @else
                            <img src="{{asset('/img/565x565.jpg')}}" alt="">
                        @endif
                    </figure>
                    @foreach($user->specializations as $value)
                        <small>
                            {{ $loop->first ? '' : ', ' }}
                            {{$value->name}}
                        </small>
                    @endforeach
                    <h1>{{$user->profile ? $user->profile->fullName : ''}}</h1>

                    <h6>{{trans('doctors.average_rating')}} </h6>
                    <?php $average = number_format($user->profile->rate/($user->profile->num_of_rates?:1), 1, '.', ''); ?>
                    <h2 class="bold padding-bottom-7">{{ $average }} <small>/ 5.0</small></h2>
                    <ul class="statistic">
                        <li>{{trans('doctors.total_num')}} {{ $user->profile->num_of_rates }}</li>
                    </ul>

                    @if(!$ratecheck)
                        <div class="">
                            <label>{{trans('doctors.rate')}}</label>
                            @for($i=0;$i<5;$i++)
                        <a href="{{ route('doctors.rate',['doctor_id'=>$user->id,'rate'=>$i+1]) }}" class="icon_star" id="star{{$i}}" aria-label="Left Align">
                                </a>
                            @endfor
                        </div>
                    @else
                        <a href="{{ route('doctors.rateCancel',['doctor_id'=>$user->id]) }}" class="btn btn-danger btn-sm">{{trans('doctors.cancel_rate')}}</a>
                        <br>
                    @endif
                    <br>
                    <span class="rating">{{trans('book.booked')}}: {{ $user->numberOfBookings }}</span>
                    @foreach($clinics as $clinic)
                        <ul class="contacts">
                            <li><h6>{{ trans('doctors.clinic_name') }}</h6>{{$clinic->name}}</li>
                            <li><h6>{{ trans('doctors.clinic_address') }}</h6>{{$clinic->address}}</li>
                            <li><h6>{{ trans('doctors.clinic_phone') }}</h6><a href="tel://{{$clinic->phone_numbers}}">{{$clinic->phone_numbers}}</a></li>
                        </ul>
                        {{-- <div class="text-center"><a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x0:0xa6a9af76b1e2d899!2sAssistance+%E2%80%93+H%C3%B4pitaux+De+Paris!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" class="btn_1 outline" target="_blank"><i class="icon_pin"></i> View on map</a></div> --}}
                        <div class="text-center"><a href="https://www.google.com/maps/dir/{{$clinic->location}}/@.{{$clinic->location}},20.5z" class="btn_1 outline" target="_blank"><i class="icon_pin"></i>{{trans('doctors.view_on_map')}}</a></div>
                        <br>
                    @endforeach
                </div>
            </aside>

            <div class="col-xl-9 col-lg-8">
                @foreach($clinics as $key => $clinic)

                    <form method="GET" action="{{ route('doctors.book', ['doctor' => $user, 'clinic' => $clinic]) }}" >
                        <div class="box_general_2 add_bottom_45">
                            <div class="main_title_4">
                                <h3><i class="icon_circle-slelected"></i>{{ trans('book.book_calendar') }}</h3>

                            </div>
                            <h3>{{$clinic->name_ru }}</h3>

                            @include('book.calendar-time')
                            <input type="checkbox" class="day_checkbox{{$key}}" style="display: none" required>
                            <input type="checkbox" class="time_checkbox{{$key}}" style="display: none" required>

                            <hr>
                            <div class="text-center"><button class="btn_1 medium" type="submit" id="{{$key}}" onclick="checkDay(event, document.getElementsByName('radio_time').value)">{{ trans('book.book_now') }}</button></div>
                        </div>
                    </form>
                @endforeach

                <div class="tabs_styled_2">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-expanded="true">{{ trans('doctors.general_info') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews">{{ trans('doctors.reviews') }}</a>
                        </li>
                    </ul>
                    <!--/nav-tabs -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="indent_title_in">
                                <i class="pe-7s-user"></i>
                                <h3>{{ trans('doctors.proff_statements') }}</h3>
                            </div>
                            <div class="wrapper_indent">
                                <p>{{$user->profile ? $user->profile->about : ''}}</p>
                                <h6>{{ trans('doctors.specs') }}</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul class="bullets">
                                            @foreach ($specs as $spec)
                                                <li> {{$spec->name}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews-container">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div id="review_summary">
                                            <strong>{{$average}}</strong>
                                            <div class="rating">
                                                @for($i=0;$i<5;$i++)
                                                    @if($i<$average)
                                                        <i class="icon_star voted"></i>
                                                    @else
                                                        <i class="icon_star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <br>
                                            <small>{{trans('doctors.total_num')}} {{$user->profile->num_of_rates}} </small>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        @php($i = 5)
                                        @foreach($rates as $rate)
                                            <div class="row">
                                                <div class="col-lg-10 col-9">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width:{{$rate*100/($user->profile->num_of_rates?:1)}}%" aria-valuenow="{{$rate * 20}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-3"><small><strong>{{$i--}} stars</strong></small></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box" id="gallery" role="gallery" aria-labelledby="gallery">
                        <div class="gallery">
                            <div class="row d-flex justify-content-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <a href="/img/Doctor{{$i}}.jpg" data-lightbox="mygallery"><img src="/img/Doctor{{$i}}.jpg"></a>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@include('book.calendar-time-js')
<script>
    baguetteBox.run('.gallery');

    //STAR HOVER
    for(var i = 0; i < 5; i++) {
        $("#star" + i).mouseover(function(event) {
            var j = 0;
            while(j <= event.target.id.slice(-1)) {
                $("#star" + j).css({"transform":"scale(1.6)", "filter":"none"});
                j++;
            }
        });
        $("#star" + i).mouseout(function() {
            var j = 0;
            while(j <= event.target.id.slice(-1)) {
                $("#star" + j).css({"transform":"scale(1)", "filter":"grayscale(100%)"});
                j++;
            }
        }); 
    }
    
</script>
@endsection

