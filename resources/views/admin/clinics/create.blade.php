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

    <form action="{{ route('admin.clinics.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('partials.admin._nav')

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="uzbek" role="tabpanel">
                                <div class="form-group">
                                    <label for="name_uz" class="col-form-label">Nomi</label>
                                    <input name="name_uz" type="text" class="form-control" placeholder="..." value="{{ old('name_uz')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="address_uz" class="col-form-label">Manzili</label>
                                    <textarea name="address_uz" type="text" class="form-control" placeholder="..." required>{{ old('address_uz')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description_uz" class="col-form-label">Tavsifi</label>
                                    <textarea name="description_uz" rows="3" type="text" class="form-control ckeditor" placeholder="..." required>{{ old('description_uz')}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="russian" role="tabpanel">
                                <div class="form-group">
                                    <label for="name_ru" class="col-form-label">Название</label>
                                    <input name="name_ru" type="text" class="form-control" placeholder="..." value="{{ old('name_ru')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="address_ru" class="col-form-label ">Адрес</label>
                                    <textarea name="address_ru" type="text" class="form-control" placeholder="..." required>{{ old('address_ru')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description_ru" class="col-form-label">Описание</label>
                                    <textarea name="description_ru" rows="3" type="text" class="form-control ckeditor" placeholder="..." required>{{ old('description_ru')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-green card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="type" class="col-form-label">Выберете тип клиники </label>
                                    <select class="form-control" name="type" id="type" required>
                                        <option hidden></option>
                                        <option value="1">Частная клиника</option>
                                        <option value="2">Государственная поликлиника</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="work_time_start" class="col-form-label">Начало работы клиники </label>
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input name="work_time_start" id="work_time_start" type="text" class="form-control timepicker"
                                               data-inputmask="&quot;mask&quot;: &quot;99:99&quot;" data-mask="" im-insert="true"
                                               value="{{ old('work_time_start')}}" required>
                                        <div class="input-group-append" data-target="#work_time_start" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="work_time_end" class="col-form-label">Конец работы клиники </label>
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input name="work_time_end" id="work_time_end" type="text" class="form-control timepicker"
                                               data-inputmask="&quot;mask&quot;: &quot;99:99&quot;" data-mask="" im-insert="true"
                                               value="{{ old('work_time_end')}}" required>
                                        <div class="input-group-append" data-target="#work_time_end" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="location" class="col-form-label">Локация </label>
                                    <input name="location" type="text" class="form-control" placeholder="..." value="{{ old('location')}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('services', 'Сервисы', ['class' => 'col-form-label']); !!}
                                    {!! Form::select('services[]', $services, old('services'),
                                        ['multiple' => true, 'class'=>'form-control' . ($errors->has('services') ? ' is-invalid' : ''), 'id' => 'services', 'required' => true]) !!}
                                    @if ($errors->has('services'))
                                        <span
                                            class="invalid-feedback"><strong>{{ $errors->first('services') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-green card-outline">
                    <div class="card-header"><h3 class="card-title">Родительский регион</h3></div>
                    <div class="card-body" id="regions">
                        <div class="form-group" id="form-group-1">
                            <label for="parentRegions" class="col-form-label">Родительский регион</label>
                            <select id="parentRegions" class="form-control parent-region{{ $errors->has('regions') ? ' is-invalid' : '' }}" name="regions[]" data-depth="1">
                                <option value=""></option>
                                @foreach ($parentRegions as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Добавить</button>
            {{-- <a href="{{ route('admin.clinics.index') }}" class="btn btn-default">Назад</a> --}}
        </div>
    </form>

@endsection

@include('admin.clinics._script')



