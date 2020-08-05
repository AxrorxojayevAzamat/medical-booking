@extends('patient.base')


@section('content')

<div class="content-wrapper">
        <div class="container-fluid" style="margin-top: 60px">
        	<div class="d-flex bd-highlight mb-3">
    </div>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-user"></i>{{trans('menu.profile_details')}}</h2>
                    <form method="POST" style="float: right;" action="{{ route('patient.destroy') }}" class="ml-auto mr-1">
                        @csrf
                        <button class="btn btn-danger mr-1 p-2" onclick="return confirm('{{ 'Вы уверены?' }}')">{{ trans('menu.delete') }}</button>
                    </form>
                    <a class="btn btn-primary mr-1 p-2 bd-highlight" style="float: right;" href="{{ route('patient.profileEdit')}}">{{ trans('menu.edit') }}</a>
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