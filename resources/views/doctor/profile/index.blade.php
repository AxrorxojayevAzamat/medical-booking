@extends('doctor.base')


@section('content')

<div class="content-wrapper">
        <div class="container-fluid" style="margin-top: 60px">
            <div class="box_general padding_bottom">
                
                
                <div class="header_box version_2">
                    <h2><i class="fa fa-user"></i>{{trans('menu.profile_details')}}</h2>

                    <h2 style="margin-left: 20px; "><i class="fa fa-user"></i>{{trans('menu.rate')}}</h2>
                    <?php $average = number_format($user->profile->rate/($user->profile->num_of_rates?:1), 1, '.', ''); ?>
                    <h2 class="bold">{{ $average }} / 5.0 </h2>
                    <a class="btn btn-primary mr-1 p-2 bd-highlight" style="float: right;" href="{{ route('doctor.profileEdit')}}">{{ trans('menu.edit') }}</a>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        @if($user->profile->mainPhoto)
                        <div class="col-md-4">        
                            <img style="width: 400px; margin:15px;" src="{{URL::to($user->profile->mainPhoto->getFileOriginalAttribute())}}" alt="">
                        </div>
                        @endif
                        @if($user->profile->photos)
                        @foreach($user->profile->photos as $photo)
                        <div class="col-md-4">        
                            <img style="width: 400px; margin:15px;" src="{{URL::to($photo->getFileOriginalAttribute())}}" alt="">
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
				<table class="table table-striped projects">
                        <tbody>
                            <tr><th>{{ trans('ID') }}</th><td>{{ $user->id }}</td></tr>
                            {{-- <tr><th>{{ trans('Логин') }}</th><td>{{ $user->name }}</td></tr> --}}
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

@stop