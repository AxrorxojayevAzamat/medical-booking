<div class="row ">

    <div class="col-3">
        <div class="form-group">
            <select class="form-control" name="reg" id="reg">
                @foreach($categories as $cat)
                    @foreach($cat->children($cat->id) as $item)
                        <option value="{{ $cat->id }}"
                                @if ($regions->parent_id == $item->id) selected="selected" hidden @endif  >{{ $cat->name_ru }} </option>
                    @endforeach
                @endforeach
            </select>
            <label>Родительский регион</label>
        </div>
    </div>

    <div class="col-3">
        <div class="form-group">
            <select class="form-control" name="region" id="reg" required>
                @foreach($categories as $cat)
                    @foreach($cat->children($cat->id) as $item)
                            <option value="{{$item->id}}" @if ($regions->parent_id == $item->id) selected="selected" @endif  >{{$item->name_ru}}</option>
                    @endforeach
                @endforeach
            </select>
            <label>Родительский город</label>
        </div>
    </div>

    <div class="form-group col-3" align='center'>
        <input name="region_uz" type="text" class="form-control" placeholder="..."
               value="{{ old('region_uz')?? $regions->name_uz ??''}}">
        <label>Название(узбексое)</label>
    </div>
    <div class="form-group col-3" align='center'>
        <input name="region_ru" type="text" class="form-control" placeholder="..."
               value="{{ old('region_ru')?? $regions->name_ru ??''}}">
        <label>Название(русское)</label>
    </div>
</div>

