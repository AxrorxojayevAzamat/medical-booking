<div class="row">
    <div class="form-group col-6" align='center'>
        <input name="region_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('region_uz')?? $regions->region_uz ??''}}">
        <label>Название региона(узбекское)</label>
    </div>

    <div class="form-group col-6" align='center'>
        <input name="region_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('region_ru')?? $regions->region_ru ??''}}">
        <label>Название региона(русское)</label>
    </div>


</div>

