<div class="row">
    <div class="col-3">
        <div class="form-group">
            <select class="form-control" name="reg" id="reg" required>
                <option hidden></option>
                @foreach($categories as $cat)

                    <option value="{{$cat->id}}">{{$cat->name_ru}}</option>

                @endforeach
            </select>
            <label>Родительский регион</label>
        </div>
    </div>


    <div class="col-3">
        <div class="form-group">
            <select class="form-control" name="region" id="reg" required>
                <option disabled>Выберете регион сначала</option>

            </select>
            <label>Родительский город</label>
        </div>
    </div>


    <div class="form-group col-3" align='center'>
        <input name="region_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('region_uz')?? $districts->name_uz ??''}}">
        <label>Название района(узбекское)</label>
    </div>

    <div class="form-group col-3" align='center'>
        <input name="region_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('region_ru')?? $districts->name_ru ??''}}">
        <label>Название района(русское)</label>
    </div>
</div>
