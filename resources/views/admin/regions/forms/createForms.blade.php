<div class="row">
    <div class="col-4">
        <!-- select -->
        <div class="form-group">
            <select class="form-control" name="region" id="region">
                <option value='<null>'>Нет</option>
            </select>
            <label>Родительский регион</label>
        </div>
    </div>

    <div class="form-group col-4" align='center'>
        <input name="region_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('region_uz')?? $regions->name_uz ??''}}">
        <label>Название региона(узбекское)</label>
    </div>

    <div class="form-group col-4" align='center'>
        <input name="region_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('region_ru')?? $regions->name_ru ??''}}">
        <label>Название региона(русское)</label>
    </div>


</div>

