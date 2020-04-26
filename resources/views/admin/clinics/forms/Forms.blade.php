
<form class="form-horizontal">
    <div class="card-body">

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Название клиники(узбекское)</label>
            <div class="col-sm-6">
                <input name="name_uz" type="text" class="form-control" placeholder="..."
                       value="{{ old('name_uz')?? $clinics->name_uz ??''}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Название клиники(русское)  </label>
            <div class="col-sm-6 ">
                <input name="name_ru" type="text" class="form-control" placeholder="..."
                value="{{ old('name_ru')?? $clinics->name_ru ??''}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label ">Выберете регион </label>
            <div class="col-sm-6 ">
                <select class="form-control" name="region_id" id="region_id"  required >
                    <option hidden ></option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Выберете тип клиники </label>
            <div class="col-sm-6 ">
                <select class="form-control" name="type" id="type"  required >
                    <option hidden ></option>
                    <option value="0" >Частная клиника</option>
                    <option  value="1">Государственная поликлиника</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Описание клиники(узбекское)</label>
            <div class="col-sm-6">
                <textarea name="description_uz" rows="3" type="text" class="form-control" placeholder="...">{{ old('description_uz')?? $clinics->description_uz ??''}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Описание клиники(русское)  </label>
            <div class="col-sm-6 ">
                <textarea name="description_ru" rows="3" type="text" class="form-control" placeholder="...">{{ old('description_ru')?? $clinics->description_ru ??''}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Телефон клиники  </label>
            <div class="col-sm-6 ">
                <input name="phone_numbers" type="text" class="form-control" placeholder="..."
                       value="{{ old('phone_numbers')?? $clinics->phone_numbers ??''}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Адресс клиники(узбекское)</label>
            <div class="col-sm-6">
                <textarea name="adress_uz" rows="3" type="text" class="form-control" placeholder="...">{{ old('adress_uz')?? $clinics->adress_uz ??''}}</textarea>

            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label">Адресс клиники(русское)  </label>
            <div class="col-sm-6 ">
                <textarea name="adress_ru" rows="3" type="text" class="form-control" placeholder="...">{{ old('adress_ru')?? $clinics->adress_ru ??''}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Рабочее время клиники </label>
            <div class="col-sm-6 ">
                <input name="work_time" type="text" class="form-control" placeholder="..."
                       value="{{ old('work_time')?? $clinics->work_time ??''}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class=" col-sm-5 col-form-label ">Локация </label>
            <div class="col-sm-6 ">
                <input name="location" type="text" class="form-control" placeholder="..."
                       value="{{ old('location')?? $clinics->location ??''}}">
            </div>
        </div>

    </div>
</form>


