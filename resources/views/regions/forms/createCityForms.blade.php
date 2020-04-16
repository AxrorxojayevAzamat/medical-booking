<div class="row">

    <div class="col-4">
        <!-- select -->
        <div class="form-group">
            <select class="form-control">
                <option>Ташкентская область</option>
                <option>Самаркандская область</option>
                <option>Андижанская область</option>
                <option>Бухарская область</option>
                <option>Хивинская область</option>
            </select>
            <label>Родительский регион</label>
        </div>
    </div>

    <div class="form-group col-4" align='center'>
        <input name="city_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('city_uz')?? $cities->name_uz ??''}}">
        <label>Название города(узбекское)</label>
    </div>

    <div class="form-group col-4" align='center'>
        <input name="city_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('city_ru')?? $cities->name_ru ??''}}">
        <label>Название города(русское)</label>
    </div>


</div>

