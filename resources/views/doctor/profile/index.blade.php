@extends('doctor.base')


@section('content')

<div class="content-wrapper">
        <div class="container-fluid" style="margin-top: 60px">
            @include('doctor.breadcrumbs')
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{trans('validation.success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="box_general padding_bottom">
                <div class="header_box version_2 row">
                    <div class="col-xl-4 col-lg-5  col-md-12 col-sm-12">
                        <h2 style="margin-bottom: 20px;"><i class="fa fa-user"></i>{{trans('menu.rate')}}</h2>
                        <?php $average = number_format($user->profile->rate/($user->profile->num_of_rates?:1), 1, '.', ''); ?>
                        <h2 class="bold">{{ $average }} / 5.0 </h2>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-12 col-sm-12 row justify-content-end">
                        <a class="btn btn-primary mr-1 mb-3 p-2 bd-highlight" href="{{ route('doctor.profileEdit')}}">{{ trans('panel.doctor.edit') }}</a>
                        <a class="btn btn-primary mr-1 mb-3 p-2 bd-highlight" href="{{ route('doctor.editSpecialization')}}">{{ trans('doctors.specs') }}</a>
                        <a class="btn btn-info mr-1 mb-3 p-2 bd-highlight" href="{{ route('doctor.main-photo', $user)}}">{{trans('menu.main_photo')}}</a>
                        <a class="btn btn-info mr-1 mb-3 p-2 bd-highlight" href="{{ route('doctor.photos')}}">{{trans('menu.photos')}}</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        @if($user->profile->mainPhoto)
                        <div class="col-md-4">        
                            <img class=".img-thumbnail" style="width: 150px; margin:15px;" src="{{URL::to($user->profile->mainPhoto->getFileOriginalAttribute())}}" alt="">
                        </div>
                        @endif
                    </div>
                </div>
				<table class="table table-striped projects">
                        <tbody>
                            <tr><th>{{ trans('ID') }}</th><td>{{ $user->id }}</td></tr>
                            <tr><th>{{ trans('contacts.email') }}</th><td>{{ $user->email }}</td></tr>
                            <tr><th>{{ trans('contacts.phone') }}</th><td>{{ $user->phone }}</td></tr>
                            <tr>
                                <th>{{ trans('menu.status') }}</th>
                                <td class="project-state">
                                    @if ($user->status === \App\Entity\User\User::STATUS_INACTIVE)
                                        <span class="badge badge-secondary">{{ trans('menu.noactive') }}</span>
                                    @endif
                                    @if ($user->status === \App\Entity\User\User::STATUS_ACTIVE)
                                        <span class="badge badge-primary">{{ trans('menu.active') }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr><th>{{ trans('specialization.type_of_doctor') }}</th><td>
                            @foreach($specializations as $specialization)
                                @if(Session::get('locale')=='uz')
                                    <span class="badge badge-secondary">{{$specialization->specialization->name_uz}}</span>
                                @else
                                    <span class="badge badge-secondary">{{$specialization->specialization->name_ru}}</span>
                                @endif
                            @endforeach
                            </td></tr>
                            <tr><th>{{ trans('contacts.name') }}</th><td>{{ $user->profile->first_name }}</td></tr>
                            <tr><th>{{ trans('contacts.lastname') }}</th><td>{{ $user->profile->last_name }}</td></tr>
                            <tr><th>{{ trans('contacts.patronymic') }}</th><td>{{ $user->profile->middle_name }}</td></tr>
                            <tr><th>{{ trans('contacts.date') }}</th><td>{{ $user->profile->birth_date }}</td></tr>
                            <tr><th>{{ trans('contacts.gender') }}</th><td>{{ $user->profile->gender === 0 ? trans('contacts.woman') : trans('contacts.man')}}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('doctor.adaptation_style')
@stop