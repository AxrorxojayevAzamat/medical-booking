@extends('adminlte::page')
@section('title','Клиники')
@section('content_header')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Клиники</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="http://localhost:8081/home">Главная </a></li>
                        <li class="breadcrumb-item"><a href="http://localhost:8081/clinic">Список клиник</a></li>
                        <li class="breadcrumb-item active">Просмотр</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@stop
@section('content')

    @if($errors->any())
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

                <h3 class="card-title">Просмотр клиники</h3>
                <div class="btn-group ml-3 ">
                    <a href="{{ route('clinic.edit',['id'=>$clinic->id]) }}"
                       class="btn btn-info btn-sm "><i class="fas fa-pencil-alt"></i></a>
                </div>
                <div class="btn-group ml-1">
                    <form action="{{ route('clinic.destroy',['id'=>$clinic->id]) }}"
                          method="post"
                          onsubmit="if(confirm('Точно удалить?')){return true} else {return false}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm "><i
                                class="fas fa-trash-alt"></i></button>
                    </form>
                </div>
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 80px; top: 6px " >
                        <a href="{{ route('clinic.index') }}" class="btn btn-default btn-sm ml-1">Назад</a>
                    </div>
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
                        <label for="inputEmail3" class="col-sm-5 col-form-label ">Выберете регион </label>
                        <div class="col-sm-6 form-control">

                            @foreach($regions as $region)

                                @if($clinic->region_id==$region->id)
                                    {{$region->name_ru}}
                                @endif

                            @endforeach

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Адресс клиники(узбекское)</label>
                        <div class="col-sm-6 form-control">
                            {{  $clinic->adress_uz }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label">Адресс клиники(русское) </label>
                        <div class="col-sm-6 form-control">
                            {{ $clinic->adress_ru}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label ">Выберете тип клиники </label>
                        <div class="col-sm-6 form-control">
                            @if($clinic->type==0)
                                Частная клиника
                            @endif
                            @if($clinic->type==1)
                                Государственная поликлиника
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Описание клиники(узбекское)</label>
                        <div class="col-sm-6 form-control">
                            {{ $clinic->description_uz }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label ">Описание
                            клиники(русское) </label>
                        <div class="col-sm-6 form-control">
                            {{  $clinic->description_ru }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label ">Телефон клиники </label>
                        <div class="col-sm-6 form-control">
                            {{  $clinic->phone_numbers }}
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

                </div>
            </div>

        </div>
    </div>




@endsection
