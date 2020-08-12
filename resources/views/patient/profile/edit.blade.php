@extends('patient.base')


@section('content')

    <div class="content-wrapper">
        <div class="container-fluid" style="margin-top: 50px">
            @if(count($errors))
                @foreach($errors as $error)
                    <h1>{{$error->get}}</h1>
                @endforeach
            @endif
            <div class="box_general padding_bottom">
                <form action="{{route('patient.profileEditSave')}}" method="post">
                    @csrf
                <div class="header_box version_2">
                    <h2><i class="fa fa-user"></i>{{trans('menu.profile_details')}}</h2>
                </div>
                <div class="row">
                    <div class="col-md-12 add_top_30">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('contacts.name')}}</label>
                                    <input type="text" class="form-control" placeholder="Your name" value="{{$user->profile->first_name}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('contacts.lastname')}}</label>
                                    <input type="text" class="form-control" placeholder="Your last name" value="{{$user->profile->last_name}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('contacts.patronymic')}}</label>
                                    <input type="text" class="form-control" placeholder="Your last name" value="{{$user->profile->last_name}}" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- /row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('contacts.phone')}}</label>
                                    <input type="text" class="form-control" placeholder="Your telephone number" name="phone" value="{{$user->phone}}">
                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback" style="display: block">
                                        <strong style="color: red;">{{ $errors->first('phone') }}</strong>
                                    </span>
                            @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('contacts.email')}}</label>
                                    <input type="email" class="form-control" placeholder="Your email" name="email" value="{{$user->email}}">
                                    @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="display: block">
                                                <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /row-->
                    </div>
                </div>
            </div>
            <!-- /box_general-->
            <div class="row">
                <div class="col-md-12">
                    <div class="box_general padding_bottom">
                        <div class="header_box version_2">
                            <h2><i class="fa fa-lock"></i>{{trans('menu.change_password')}}</h2>
                        </div>
                        <div class="form-group">
                            <label>{{trans('menu.old_password')}}</label>
                            <input class="form-control col-md-6 col-12" type="password" name="oldpass">
                            @if (Session::has('oldpass'))
                                    <span class="invalid-feedback" style="display: block">
                                        <strong style="color: red;">{{ trans('validation.oldpass') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('menu.new_password')}}</label>
                            <input class="form-control col-md-6 col-12" type="password" name="newpass">
                            @if ($errors->has('newpass'))
                                    <span class="invalid-feedback" style="display: block">
                                        <strong style="color: red;">{{ trans('validation.newpass') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('menu.conf_password')}}</label>
                            <div class="row justify-content-between mx-0">
                                <input class="form-control  col-md-6 col-12 mb-3" type="password" name="confpass">
                                <button style="float: right" class="btn btn-success col-md-2 col-12 mb-3">{{trans('menu.save')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                </form>
            </div>
            <!-- /row-->
        </div>
        <!-- /.container-fluid-->
    </div>
@stop