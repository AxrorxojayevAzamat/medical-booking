<div class="card-columns">

    <div class="form-group " align='center'>
        <input name="name_uz" type="text" class="form-control" placeholder="region..."
               value="{{ old('name_uz')?? $regions->name_uz ??''}}">
        <label>Название(узбексое)</label>
    </div>

    <div class="form-group" align='center'>
        <input name="name_ru" type="text" class="form-control" placeholder="регион..."
               value="{{ old('name_ru')?? $regions->name_ru ??''}}">
        <label>Название(русское)</label>
    </div>

    <div class="form-group " align='center'>
    <input type="submit" value="Редактировать" class="btn btn-primary">
    <a href="{{ route('region.index') }}" class="btn btn-success">Назад</a>
    </div>

</div>

