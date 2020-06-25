@extends('layouts.admin.page')

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
            <div class="d-flex flex-row mb-3">
                <a href="{{ route('admin.clinic.edit', $clinic)}}" class="btn btn-primary mr-1">Редактировать</a>

                <a href="{{route('admin.clinic.main-photo', $clinic )}}" class="btn btn-dark mr-1">Добавить главное фото</a>

                <form action="{{ route('admin.clinic.destroy',$clinic) }}" method="post">
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
                            @if($clinic->type==1)
                                Частная клиника
                            @endif
                            @if($clinic->type==2)
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

                    <div class="form-group row">
                        <label for="inputEmail3" class=" col-sm-5 col-form-label ">Фотография клиники </label>
                        @if( !empty($clinic->photo))
                            <div class="text-center">
                                <?php foreach (json_decode($clinic->photo)as $picture) { ?>
                                    <img src="/uploads/photo_clinics/{{$picture }}"/>
                                <?php } ?>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>




@endsection
