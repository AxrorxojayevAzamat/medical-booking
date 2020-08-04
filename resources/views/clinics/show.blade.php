@extends('layouts.app')

@section('content')
    @section('css')
    <link rel="stylesheet" type="text/css" href="/css/gallery.css">
    <link rel="stylesheet" type="text/css" href="/css/lightbox.gallery.min.css">
    @endsection
    
    <div class="container margin_60">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <nav id="secondary_nav">
                    <div class="container">
                        <ul class="clearfix">
                            <li><a href="#section_1" class="active">Основная информация</a></li>
                            <li><a href="#section_1">Основная информация</a></li>
                        </ul>
                    </div>
                </nav>
                <div id="section_1">
                    <div class="box_general_3">
                        <div class="profile">
                            <div class="row">
                                <div class="col-lg-5 col-md-4">
                                    <figure>
                                        <img src="{{ $clinic->mainPhoto ? $clinic->mainPhoto->fileThumbnail : 'http://via.placeholder.com/565x565.jpg' }}" alt="" class="img-fluid">
                                    </figure>
                                </div>
                                <div class="col-lg-7 col-md-8">
                                    <small>{{ $clinic->region->name }}</small>
                                    <h1>{{ $clinic->name }}</h1>
                                    <ul class="statistic">
                                        <li>{{ $clinic->doctorClinics()->count() }} доктора</li>
                                    </ul>
                                    <ul class="contacts">
                                        <li>
                                            <h6>Адрес:</h6>
                                            {{ $clinic->address }}
                                            <a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x0:0xa6a9af76b1e2d899!2sAssistance+%E2%80%93+H%C3%B4pitaux+De+Paris!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" target="_blank"> <strong>Показать на карте</strong></a>
                                        </li>
                                        @if ($phoneNumbers)
                                            <li>
                                                <h6>Номер телефона:</h6>
                                                @foreach($phoneNumbers as $phoneNumber)
                                                    <a href="tel://{{ $phoneNumber }}">{{ $phoneNumber }}</a><br>
                                                @endforeach
                                            </li>
                                        @endif
                                        @if ($faxNumbers)
                                            <li>
                                                <h6>Номер факса:</h6>
                                                @foreach($faxNumbers as $faxNumber)
                                                    {{ $faxNumber }}<br>
                                                @endforeach
                                            </li>
                                        @endif
                                        @if ($faxNumbers)
                                            <li>
                                                <h6>Электронный адрес:</h6>
                                                @foreach($emails as $email)
                                                    <a href="mailto: {{ $email }}">{{ $email }}</a><br>
                                                @endforeach
                                            </li>
                                        @endif
                                        <li>
                                            <h6>Время работы:</h6>
                                            {{ $clinic->work_time_start }} - {{ $clinic->work_time_end }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="indent_title_in">
                            <i class="pe-7s-user"></i>
                            <h3>Описание</h3>
                            <p>{{ $clinic->typeName() }}</p>
                        </div>
                        <div class="wrapper_indent">
                            <p>{{ $clinic->description }}</p>
                        </div>
                        
                    </div>
                     <div class="box" id="gallery" role="gallery" aria-labelledby="gallery">
                        <div class="gallery">
                            <div class="row d-flex justify-content-center">
                                <a href="/img/Doctor1.jpg" data-lightbox="mygallery"><img src="/img/Doctor1.jpg" style="width: 130px; height: 115px;"></a>
                                <a href="/img/Doctor2.jpg" data-lightbox="mygallery"><img src="/img/Doctor2.jpg" style="width: 130px; height: 115px;"></a>
                                <a href="/img/Doctor3.jpg" data-lightbox="mygallery"><img src="/img/Doctor3.jpg" style="width: 130px; height: 115px;"></a>
                                <a href="/img/Doctor4.jpg" data-lightbox="mygallery"><img src="/img/Doctor4.jpg" style="width: 130px; height: 115px;"></a>
                                <a href="/img/Doctor5.jpg" data-lightbox="mygallery"><img src="/img/Doctor5.jpg" style="width: 130px; height: 115px;"></a>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
            <!-- /col -->
            <aside class="col-xl-4 col-lg-4" id="sidebar">
                <div class="box_general_3 booking">
                    <div class="title">
                        <h3>Book a Visit</h3>
                        <small>Monday to Friday 09.00am-06.00pm</small>
                    </div>
                    <div id="message-booking"></div>
                    <form method="post" action="assets/booking.php" id="booking">
                        <input type="hidden" value="Dr. Julia Jhones" name="doctor_name_booking" id="doctor_name_booking">
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Name" name="name_booking" id="name_booking">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Last Name" name="lastname_booking" id="lastname_booking">
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email Address" name="email_booking" id="email_booking">
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" id="booking_date" name="booking_date" data-lang="en" data-min-year="2017" data-max-year="2020" data-disabled-days="10/17/2017,11/18/2017">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" id="booking_time" name="booking_time">
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <select class="form-control" name="booking_visit" id="booking_visit">
                                        <option value="">Select visit</option>
                                        <option value="General visit">General visit</option>
                                        <option value="Cardiothoracic Radiology">Cardiothoracic Radiology</option>
                                        <option value="Abdominal Radiology">Abdominal Radiology</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea rows="5" id="booking_message" name="booking_message" class="form-control" style="height:80px;" placeholder="Additional message"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" id="verify_booking" class="form-control" placeholder="Human verify: 3 + 1 =?">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div style="position:relative;"><input type="submit" class="btn_1 full-width" value="Book Now" id="submit-booking"></div>
                    </form>
                </div>
            </aside>
        </div>
    </div>
@endsection
@section('scripts')
{{-- <script type="text/javascript" src="/js/lightbox-plus-jquery.min.js"></script> --}}
{{-- <script src="js/baguetteBox.js" async></script> --}}
<script type="text/javascript">

    baguetteBox.run('.gallery');
</script>
@endsection

@section('css')
{{-- <link rel="stylesheet" href="css/baguetteBox.css"> --}}
@endsection
