<div class="row">

    <div class="col-4">
        <!-- select -->
        <div class="form-group">
            <select class="form-control" name="region" id="region"  required >
               <option hidden ></option>
                @foreach($categories as $cat)
                    <option  value="{{$cat->id}}">{{$cat->name_ru}}</option>
                @endforeach
            </select>
            <label>Родительский регион</label>
        </div>
    </div>

    <div class="form-group col-4" align='center'>
        <input name="region_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('region_uz')?? $cities->name_uz ??''}}">
        <label>Название города(узбекское)</label>
    </div>

    <div class="form-group col-4" align='center'>
        <input name="region_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('region_ru')?? $cities->name_ru ??''}}">
        <label>Название города(русское)</label>
    </div>


</div>

