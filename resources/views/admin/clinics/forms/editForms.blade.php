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
            <label for="inputEmail3" class="col-sm-5 col-form-label">Адресс клиники(uz)</label>
            <div class="col-sm-6">
                <textarea name="adress_uz" rows="3" type="text" class="form-control"
                          placeholder="..." required>{{ old('address_uz')?? $clinic->address_uz ??''}}</textarea>

            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label">Адресс клиники(ru) </label>
            <div class="col-sm-6 ">
                <textarea name="adress_ru" rows="3" type="text" class="form-control"
                          placeholder="..." required>{{ old('address_ru') ?? $clinic->address_ru ??''}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Выберете тип клиники </label>
            <div class="col-sm-6 ">
                <select class="form-control" name="type" id="type" required>
                    <option hidden></option>
                    <option value="1" @if ($clinic->type == '1') selected="selected" @endif>Частная клиника</option>
                    <option value="2" @if ($clinic->type == '2') selected="selected" @endif>Государственная поликлиника</option>
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
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Телефон клиники </label>
            <div class="col-sm-6 ">
                <input name="phone_numbers" id="phone_numbers" type="text" class="form-control"
                       data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask="" im-insert="true"
                       value="{{ old('phone_numbers')?? $clinic->phone_numbers ??''}}" required>
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
    </div>
</div>






