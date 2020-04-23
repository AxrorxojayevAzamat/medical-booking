<div class="form-group col-5" align='center'>
        <div class="form-group">
            <input name="date" type="date" class="form-control" value="{{ old('date')?? $celebrations->date ??''}}" >
            <label>Введите дату:</label>
        </div>
</div>

<div class="form-group col-5" align='center'>
    <input name="celebration_name" type="text" class="form-control" placeholder="..."
           value="{{ old('name')?? $celebrations->name ??''}}">
    <label>Название праздника</label>
</div>

<div class="form-group col-5" align='center'>
    <input name="quantity" type="text" class="form-control" placeholder="..."
           value="{{ old('quantity')?? $celebrations->quantity ??1}}">
    <label>Количество дней</label>
</div>


