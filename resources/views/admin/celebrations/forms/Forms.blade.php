<div class="row">

    <div class="form-group col-5" align='center'>
        <form>
            <div class="form-group">
                <input name="date" type="date" class="form-control">
                <label>Введите дату:</label>
            </div>
        </form>

    </div>

    <div class="form-group col-5" align='center'>
        <input name="celebration_name" type="text" class="form-control" placeholder="..."
               value="{{ old('celebration_name')?? $celebrations->name ??''}}">
        <label>Название праздника</label>
    </div>

    <div class="form-group col-2" align='center'>
        <input name="quantity" type="text" class="form-control" placeholder="..."
               value="{{ old('quantity')?? $celebrations->quantity ??''}}">
        <label>Количество дней</label>
    </div>

</div>
