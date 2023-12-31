@extends('layouts.admin.page')

@section('content')

    @if($errors->count() > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif

    <div class=" card col-md-10 offset-md-1">
        <div class="card-header ">
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.clinics.edit', $clinic) }}" class="btn btn-primary mr-1">Редактировать</a>
                <a href="{{ route('admin.clinics.main-photo', $clinic) }}" class="btn btn-info mr-1">Главное фото</a>
                <a href="{{route('admin.clinics.photos', $clinic)}}" class="btn btn-info mr-1">Фотографии</a>
                <a href="{{ route('admin.clinics.contacts.create', $clinic) }}" class="btn btn-success mr-1">Добавить контакт</a>
                <form action="{{ route('admin.clinics.destroy', $clinic) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Хотите удалить?')" >Удалить</button>
                </form>
            </div>
        </div>

        <div align='center'>
            <div class="form-horizontal">
                <div class="card-body">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Название клиники(узбекское)</label>
                        <div class="col-sm-6 form-control">
                            {{ $clinic->name_uz }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label ">Название
                            клиники(русское) </label>
                        <div class="col-sm-6 form-control">
                            {{ $clinic->name_ru }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label ">Регион</label>
                        <div class="col-sm-6 form-control">
                            {{ $clinic->region->name }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Адресс клиники(uz)</label>
                        <div class="col-sm-6 form-control">
                            {{  $clinic->address_uz }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label">Адресс клиники(ru) </label>
                        <div class="col-sm-6 form-control">
                            {{ $clinic->address_ru}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label ">Выберете тип клиники </label>
                        <div class="col-sm-6 form-control">
                            @if($clinic->type==1)
                                Частная клиника
                            @endif
                            @if($clinic->type==2)
                                Государственная поликлиника
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Описание клиники(uz)</label>
                        <div class="col-sm-6 form-control">
                            {!! $clinic->description_uz !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label ">Описание клиники(ru)</label>
                        <div class="col-sm-6 form-control">
                            {!! $clinic->description_ru !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label ">Начало работы клиники </label>
                        <div class="col-sm-6 form-control">
                            {{  $clinic->work_time_start }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label ">Конец работы клиники </label>
                        <div class="col-sm-6 form-control">
                            {{  $clinic->work_time_end }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label ">Локация </label>
                        <div class="col-sm-6 form-control">
                            {{  $clinic->location}}
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label ">Главное фото клиники </label>
                        @if($clinic->mainPhoto)
                            <div class="text-center">
                                    <img src="/storage/images/clinics/{{$clinic->id}}/thumbs/{{$clinic->mainPhoto->filename}}">
                            </div>
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    @if (!$contacts->isEmpty())
        <div class=" card col-md-10 offset-md-1">
            <div class="card-body table-responsive p-0">
                <table class=" table table-bordered table-hover ">
                    <thead>
                    <tr align="center">
                        <th>Тип</th>
                        <th>Значение</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td class="text-center py-1 ">{{ $contact->getTypeName() }} </td>
                            <td class="text-center py-1 ">{{ $contact->value }}</td>
                            <td class="text-center py-1 ">
                                <div class="btn-group  ">
                                    <a href="{{ route('admin.clinics.contacts.show', ['clinic' => $clinic, 'contact' => $contact]) }}"
                                       class="btn btn-primary btn-sm"> <i class="fas fa-eye"></i></a>
                                </div>
                                <div class="btn-group  ">
                                    <a href="{{ route('admin.clinics.contacts.edit', ['clinic' => $clinic, 'contact' => $contact]) }}"
                                       class="btn btn-primary btn-sm"> <i class="fas fa-pencil-alt"></i></a>
                                </div>
                                <div class="btn-group ">
                                    <form action="{{ route('admin.clinics.contacts.destroy', ['clinic' => $clinic, 'contact' => $contact]) }}"
                                          method="post" onsubmit="if(confirm('Точно удалить?')) { return true } else { return false }">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="card col-md-10 offset-md-1" id="services">
        <div class="card-header card-green with-border">Сервисы</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Иконка</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach ($clinic->clinicServices as $clinicService)
                    @php($service = $clinicService->service)
                    <tr>
                        <td><a href="{{ route('admin.services.show', $service) }}">{{ $service->name_ru }}</a></td>
                        <td><a href="{{ $service->iconOriginal }}" target="_blank"><img src="{{ $service->iconThumbnail }}"></a></td>
                        <td>
                            <div class="d-flex flex-row">
                                <form method="POST" action="{{ route('admin.clinics.services.first', ['clinic' => $clinic, 'service' => $service]) }}" class="mr-1">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-double-up"></span></button>
                                </form>
                                <form method="POST" action="{{ route('admin.clinics.services.up', ['clinic' => $clinic, 'service' => $service]) }}" class="mr-1">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-up"></span></button>
                                </form>
                                <form method="POST" action="{{ route('admin.clinics.services.down', ['clinic' => $clinic, 'service' => $service]) }}" class="mr-1">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-down"></span></button>
                                </form>
                                <form method="POST" action="{{ route('admin.clinics.services.last', ['clinic' => $clinic, 'service' => $service]) }}" class="mr-1">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-double-down"></span></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
