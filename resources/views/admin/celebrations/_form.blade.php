<div class="form-group col-5" align='center'>
    <input name="name_uz" type="text" class="form-control" placeholder="..."
           value="{{ old('name_uz')?? $celebration->name_uz ??''}}">
    <label>Название праздника(uz)</label>
</div>
<div class="form-group col-5" align='center'>
    <input name="name_ru" type="text" class="form-control" placeholder="..."
           value="{{ old('name_ru')?? $celebration->name_ru ??''}}">
    <label>Название праздника(ru)</label>
</div>

<div class="form-group col-5" align='center'>
        <div class="form-group">
            <input name="date" type="date" id="celeb_date" class="form-control" value="{{ old('date', $celebration->date ? $celebration->date->format('Y-m-d') : '') }}">
            <label>Введите дату:</label>
        </div>
</div>

<div class="form-group col-5" align='center'>
    <input name="quantity" type="text" class="form-control" placeholder="..."
           value="{{ old('quantity')?? $celebration->quantity ??1}}">
    <label>Количество дней</label>
</div>


