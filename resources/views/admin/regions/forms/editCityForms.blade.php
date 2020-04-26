<div class="row ">
    <div class="col-4">
        <!-- select -->
        <div class="form-group">
            <select class="form-control" name="region" id="region" >

                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ (collect(old('region'))->contains($cat->id)) ? 'selected':'' }}>{{ $cat->name_ru }}</option>
                @endforeach

            </select>
            <label>Родительский регион</label>
        </div>
    </div>
    <div class="form-group col-4" align='center' >
        <input name="region_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('region_uz')?? $regions->name_uz ??''}}">
        <label>Название(узбексое)</label>
    </div>
    <div class="form-group col-4" align='center'>
        <input name="region_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('region_ru')?? $regions->name_ru ??''}}">
        <label>Название(русское)</label>
    </div>
</div>

