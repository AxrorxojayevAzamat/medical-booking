<div class="card-columns">
    <div class="form-group" align='center'>
        <label>Название региона(узбекское)</label>
        <input name="region_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('region_uz')?? $regions->region_uz ??''}}">
    </div>

    <div class="form-group" align='center'>
        <label>Название региона(русское)</label>
        <input name="region_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('region_ru')?? $regions->region_ru ??''}}">
    </div>

    <div class="form-group" align='center'>
        <label>Название города(узбекское)</label>
        <input name="city_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('city_uz')?? $regions->city_uz ??''}}">
    </div>

    <div class="form-group" align='center'>
        <label>Название города(русское)</label>
        <input name="city_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('city_ru')?? $regions->city_ru ??''}}">
    </div>

    <div class="form-group" align='center'>
        <label>Название района(узбекское)</label>
        <input name="district_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('district_uz')?? $regions->district_uz ??''}}">
    </div>

    <div class="form-group" align='center'>
        <label>Название района(русское)</label>
        <input name="district_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('district_ru')?? $regions->district_ru ??''}}">
    </div>
</div>

