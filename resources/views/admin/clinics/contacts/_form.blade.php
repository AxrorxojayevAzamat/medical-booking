<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('type', 'Тип', ['class' => 'col-form-label']); !!}
                            {!! Form::select('type', $types, old('type', $contact ? $contact->type : null),
                                ['class'=>'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'required' => true, 'placeholder' => '']) !!}
                            @if ($errors->has('type'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('type') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('value', 'Значение', ['class' => 'col-form-label']); !!}
                            {!! Form::text('value', old('value', $contact ? $contact->value : null), ['class'=>'form-control' . ($errors->has('value') ? ' is-invalid' : ''), 'required' => true]) !!}
                            @if ($errors->has('value'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('value') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="form-group" id="submit-button">
    <button type="submit" class="btn btn-primary">{{ ($contact ? 'Редактировать' : 'Добавить') }}</button>
</div>
