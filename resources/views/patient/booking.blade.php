@extends('layouts.app')

@section('content')

    <div id="page">
        <main>
            <div class="container margin_60">
                <div class="row">
                    <div class="col-xl-8 col-lg-8">
                        <div class="box_general_3 cart">
                            <div class="message">
                            </div>
                            <div class="form_title">
                                <h3><strong>1</strong>Ваши данные</h3>
                                <p>
                                    Mussum ipsum cacilds, vidis litro abertis.
                                </p>
                            </div>
                            <div class="step">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Имя</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{$patient->profile ? $patient->profile->first_name : ''}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Фамилия</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"  value="{{$patient->profile ? $patient->profile->last_name : ''}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Отчество</label>
                                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{$patient->profile ? $patient->profile->middle_name : ''}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">

                                        <div class="form-group">
                                            <label>Телефон</label>
                                            <input type="text" id="phone" name="phone" class="form-control" value="{{$patient ? $patient->phone : ''}}" disabled>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" id="email" name="email" class="form-control" value="{{$patient ? $patient->email : ''}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Описание</label>
                                            <textarea class="form-control" name="description" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!--End step -->

                            <div class="form_title">
                                <h3><strong>2</strong>Payment Information</h3>
                                <p>
                                    Mussum ipsum cacilds, vidis litro abertis.
                                </p>
                            </div>
                            @include('patient.payme-click')
                            <hr>
                            <!--End step -->

                            <div class="form_title">
                                <h3><strong>3</strong>Billing Address</h3>
                                <p>
                                    Mussum ipsum cacilds, vidis litro abertis.
                                </p>
                            </div>
                            <div class="step">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Country</label>
                                        <div class="form-group">
                                            <select class="form-control" name="country" id="country">
                                                <option value="">Select your country</option>
                                                <option value="Europe">Europe</option>
                                                <option value="United states">United states</option>
                                                <option value="Asia">Asia</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Street line 1</label>
                                            <input type="text" id="street_1" name="street_1" class="form-control" placeholder="Street line 1">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Street line 2</label>
                                            <input type="text" id="street_2" name="street_2" class="form-control" placeholder="Street line 1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" id="city_booking" name="city_booking" class="form-control" placeholder="Miami">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" id="state_booking" name="state_booking" class="form-control" placeholder="Florida">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Postal code</label>
                                            <input type="text" id="postal_code" name="postal_code" class="form-control" placeholder="00342">
                                        </div>
                                    </div>
                                </div>
                                <!--End row -->
                            </div>
                            <hr>
                            <!--End step -->
                            <div id="policy">
                                <h4>Cancellation policy</h4>
                                <div class="form-group">
                                    <div class="checkboxes">
                                        <label class="container_check">I accept <a href="#0">terms and conditions and general policy</a>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /col -->
                    <aside class="col-xl-4 col-lg-4" id="sidebar">
                        <div class="box_general_3 booking">
                            <form method="POST" action="{{ route("patient.booking-doctor") }}" enctype="multipart/form-data">
                                @csrf
                                <div class="title">
                                    <h3>{{trans('Ваше бронирование')}}</h3>
                                </div>
                                <div class="summary">
                                    <ul>
                                        <li>{{trans('Дата')}} <strong class="float-right">{{$calendar}}</strong></li>
                                        <li>{{trans('Время')}} <strong class="float-right">{{$radioTime}}</strong></li>
                                        <li>{{trans('Имя доктора:')}} <strong class="float-right">{{$user->profile ? $user->profile->fullName : ''}}</strong></li>
                                    </ul>
                                </div>
                                <ul class="treatments checkout clearfix">
                                    <li>
                                        {{trans('Стоимость бронирования')}} <strong class="float-right">
                                            {{$price}} {{$currency}}

                                        </strong>
                                    </li>
                                </ul>
                                <hr>
                                <input name="patient_id" type="hidden" value="{{$patient->id}}" id="patient_id"/>
                                <input name="doctor_id" type="hidden" value="{{$user->id}}" id="doctor_id"/>
                                <input name="clinic_id" type="hidden" value="{{$clinic->id}}" id="clinic_id"/>
                                <input name="time_start" type="hidden" value="{{$radioTime}}" id="time_start"/>
                                <input name="booking_date" type="hidden" value="{{$calendar}}" id="booking_date"/>
                                <input name="merchant_id" type="hidden" value="5f07150278994c390463280c" id="payme_merchant_id"/>
                                <button type="submit" class="btn_1 full-width">{{ trans('Confirm and pay')}}</button>
                            </form>
                        </div>
                        <!-- /box_general -->
                    </aside>
                    <!-- /asdide -->
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

