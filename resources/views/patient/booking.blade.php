@extends('layouts.app')

@section('content')

<div id="page">
    <main>
        <div class="container margin_60">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="box_general_3 cart">
                        <div class="form_title">
                            <h3><strong>1</strong>{{ trans('book.your_data') }}</h3>
                        </div>
                        <div class="step">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>{{ trans('adminlte.user.first_name') }}</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{$patient->profile ? $patient->profile->first_name : ''}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>{{ trans('adminlte.user.last_name') }}</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"  value="{{$patient->profile ? $patient->profile->last_name : ''}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>{{ trans('adminlte.user.middle_name') }}</label>
                                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{$patient->profile ? $patient->profile->middle_name : ''}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">

                                    <div class="form-group">
                                        <label>{{ trans('adminlte.user.phone') }}</label>
                                        <input type="text" id="phone" name="phone" class="form-control" value="{{$patient ? $patient->phone : ''}}" disabled>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>{{ trans('adminlte.email') }}</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{$patient ? $patient->email : ''}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ trans('book.description') }}</label>
                                        <textarea class="form-control" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--End step -->

                        <div class="form_title">
                            <h3><strong>2</strong>{{ trans('book.payment_info') }}</h3>
                        </div>

                        @include('patient.payme-click')

                        <hr>
                        <!--End step -->
                    </div>
                </div>
                <!-- /col -->
                <aside class="col-xl-4 col-lg-4" id="sidebar">
                    <div class="box_general_3 booking">
                        <form method="POST" action="{{ route("patient.booking-doctor") }}" enctype="multipart/form-data">
                            @csrf
                            <div class="title">
                                <h3>{{ trans('book.your_booking') }}</h3>
                            </div>
                            <div class="summary">
                                <ul>
                                    <li>{{ trans('book.booking_date') }} <strong class="float-right">{{$calendar}}</strong></li>
                                    <li>{{ trans('book.booking_time') }} <strong class="float-right">{{$radioTime}}</strong></li>
                                    <li>{{ trans('book.name_of_doctor') }} <strong class="float-right">{{$user->profile ? $user->profile->fullName : ''}}</strong></li>
                                </ul>
                            </div>
                            <ul class="treatments checkout clearfix">
                                <li>
                                    {{ trans('book.booking_cost') }} <strong class="float-right">
                                        {{$price}} {{$currency}}

                                    </strong>
                                </li>
                            </ul>
                            {{-- <hr> --}}

                            {{-- <button type="submit" class="btn_1 full-width">{{ trans('Confirm and pay')}}</button> --}}
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

