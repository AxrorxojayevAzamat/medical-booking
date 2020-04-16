<div class="row">

    <div class="col-4">
        <!-- select -->
        <div class="form-group">
            <select class="form-control">
                @foreach($regions as $region)
                <option>{{$region->name_ru}}</option>
                @endforeach
            </select>
            <label>Родительский регион</label>
        </div>
    </div>

    <div class="form-group col-4" align='center'>
        <input name="city_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('region_uz')?? $region_uz->name_uz ??''}}">
        <label>Название города(узбекское)</label>
    </div>

    <div class="form-group col-4" align='center'>
        <input name="city_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('region_ru')?? $region_ru->name_ru ??''}}">
        <label>Название города(русское)</label>
    </div>


</div>

