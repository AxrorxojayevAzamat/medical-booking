<div class="row">

    <div class="col-3">
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

    <div class="col-3">
        <!-- select -->
        <div class="form-group">
            <select class="form-control">
                <option>Ташкентская область</option>
                <option>Самаркандская область</option>
                <option>Андижанская область</option>
                <option>Бухарская область</option>
                <option>Хивинская область</option>
            </select>
            <label>Родительский город</label>
        </div>
    </div>

    <div class="form-group col-3" align='center'>
        <input name="district_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('district_uz')?? $districts->name_uz ??''}}">
        <label>Название района(узбекское)</label>
    </div>

    <div class="form-group col-3" align='center'>
        <input name="district_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('district_ru')?? $districts->name_ru ??''}}">
        <label>Название района(русское)</label>
    </div>


</div>

