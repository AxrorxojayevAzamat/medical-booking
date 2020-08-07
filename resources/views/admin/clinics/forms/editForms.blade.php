@if (!config('adminlte.enabled_laravel_mix'))
    @php($javaScriptSectionName = 'js')
@else
    @php($javaScriptSectionName = 'mix_adminlte_js')
@endif

<div class="form-horizontal">
    <div class="card-body">

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Название клиники(узбекское)</label>
            <div class="col-sm-6">
                <input name="name_uz" type="text" class="form-control" placeholder="..."
                       value="{{ old('name_uz')?? $clinic->name_uz ??''}}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Название клиники(русское) </label>
            <div class="col-sm-6 ">
                <input name="name_ru" type="text" class="form-control" placeholder="..."
                       value="{{ old('name_ru')?? $clinic->name_ru ??''}}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label ">Выберете регион </label>
            <div class="col-sm-6 ">
                <select class="form-control" name="region_id" id="region_id" required>
                    <option hidden></option>
                    @foreach($regions as $region)
                        <option value="{{$region->id}}"@if ($clinic->region_id == $region->id) selected="selected" @endif>{{$region->name_ru}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Адресс клиники(узбекское)</label>
            <div class="col-sm-6">
                <textarea name="address_uz"  type="text" class="form-control"
                          placeholder="..." required>{{ old('address_uz')?? $clinic->address_uz ??''}}</textarea>

            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label">Адресс клиники(русское) </label>
            <div class="col-sm-6 ">
                <textarea name="address_ru"  type="text" class="form-control"
                          placeholder="..." required>{{ old('address_ru')?? $clinic->address_ru ??''}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Выберете тип клиники </label>
            <div class="col-sm-6 ">
                <select class="form-control" name="type" id="type" required>
                    <option hidden></option>
                    <option value="1" @if ($clinic->type == 1) selected="selected" @endif>Частная клиника</option>
                    <option value="2" @if ($clinic->type == 2) selected="selected" @endif>Государственная поликлиника</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Описание клиники(узбекское)</label>
            <div class="col-sm-6">
                <textarea name="description_uz" rows="3" type="text" class="form-control"
                          placeholder="..." required >{{ old('description_uz')?? $clinic->description_uz ??''}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Описание клиники(русское) </label>
            <div class="col-sm-6 ">
                <textarea name="description_ru" rows="3" type="text" class="form-control"
                          placeholder="..." required>{{ old('description_ru')?? $clinic->description_ru ??''}}</textarea>
            </div>
        </div>


        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Начало работы клиники </label>
            <div class="col-sm-6 input-group date" id="timepicker" data-target-input="nearest">
                <input name="work_time_start" id="timepickerstart" type="text" class="form-control timepicker"
                       data-inputmask="&quot;mask&quot;: &quot;99:99&quot;" data-mask="" im-insert="true"
                       value="{{ old('work_time_start')?? $clinic->work_time_start ??''}}" required>
                <div class="input-group-append" data-target="#timepickerstart" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Конец работы клиники </label>
            <div class="col-sm-6 input-group date" id="timepicker" data-target-input="nearest">
                <input name="work_time_end" id="timepickerend" type="text" class="form-control timepicker"
                       data-inputmask="&quot;mask&quot;: &quot;99:99&quot;" data-mask="" im-insert="true"
                       value="{{ old('work_time_end')?? $clinic->work_time_end ??''}}" required>
                <div class="input-group-append" data-target="#timepickerend" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                </div>
            </div>
        </div>


        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Локация </label>
            <div class="col-sm-6 ">
                <input name="location" type="text" class="form-control" placeholder="..."
                       value="{{ old('location')?? $clinic->location ??''}}" required>
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('services', 'Сервисы', ['class' => 'col-sm-5 col-form-label']); !!}
            <div class="col-sm-6 ">
                {!! Form::select('services[]', $services, old('services', $clinic ? $clinic->servicesList() : null),
                    ['multiple' => true, 'class'=>'form-control' . ($errors->has('services') ? ' is-invalid' : ''), 'id' => 'services', 'required' => true]) !!}
            </div>
            @if ($errors->has('services'))
                <span class="invalid-feedback"><strong>{{ $errors->first('services') }}</strong></span>
            @endif
        </div>

        {{-- <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Фотография клиники </label>
            <div class="input-group col-sm-6">
                    @foreach (json_decode($clinics->photo)as $picture)
                        <img src="/uploads/photo_clinics/{{$picture }}"/>
                    @endforeach

                <div class="file-loading">
                    <input id="input-id" type="file" class="file" multiple data-preview-file-type="text" name = "images[]" data-show-upload="false" accept="jpg|jpeg|pdf|png" data-allowed-file-extensions='["jpg", "jpeg","pdf", "png"]'>
                </div>
            </div>
        </div> --}}

    </div>
</div>

@section($javaScriptSectionName)
    <script>
        // $('#services').select2();
    </script>
@endsection
