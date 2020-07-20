@if (!config('adminlte.enabled_laravel_mix'))
    @php($javaScriptSectionName = 'js')
@else
    @php($javaScriptSectionName = 'mix_adminlte_js')
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="uzbek" role="tabpanel">
                        <div class="form-group">
                            {!! Form::label('title_uz', 'Nomi', ['class' => 'col-form-label']); !!}
                            {!! Form::text('title_uz', old('title_uz', $news ? $news->title_uz : null), ['class'=>'form-control' . ($errors->has('title_uz') ? ' is-invalid' : ''), 'required' => true]) !!}
                            @if ($errors->has('title_uz'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('title_uz') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('menu_title_uz', 'Menyu nomi', ['class' => 'col-form-label']); !!}
                            {!! Form::text('menu_title_uz', old('menu_title_uz', $news ? $news->menu_title_uz : null), ['class'=>'form-control' . ($errors->has('menu_title_uz') ? ' is-invalid' : ''), 'required' => true]) !!}
                            @if ($errors->has('menu_title_uz'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('menu_title_uz') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('description_uz', 'Tavsifi', ['class' => 'col-form-label']); !!}
                            {!! Form::textarea('description_uz', old('description_uz', $news ? $news->description_uz : null),
                                ['class' => 'form-control' . ($errors->has('description_uz') ? ' is-invalid' : ''), 'id' => 'description_uz', 'rows' => 10]); !!}
                            @if ($errors->has('description_uz'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('description_uz') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('content_uz', 'To`liq ma`lumot', ['class' => 'col-form-label']); !!}
                            {!! Form::textarea('content_uz', old('content_uz', $news ? $news->content_uz : null),
                                ['class' => 'form-control ckeditor' . ($errors->has('content_uz') ? ' is-invalid' : ''), 'id' => 'content_uz', 'rows' => 10]); !!}
                            @if ($errors->has('content_uz'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('content_uz') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane" id="russian" role="tabpanel">
                        <div class="form-group">
                            {!! Form::label('title_ru', 'Название', ['class' => 'col-form-label']); !!}
                            {!! Form::text('title_ru', old('title_ru', $news ? $news->title_ru : null), ['class'=>'form-control' . ($errors->has('title_ru') ? ' is-invalid' : ''), 'required' => true]) !!}
                            @if ($errors->has('title_ru'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('title_ru') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('menu_title_ru', 'Название меню', ['class' => 'col-form-label']); !!}
                            {!! Form::text('menu_title_ru', old('menu_title_ru', $news ? $news->menu_title_ru : null), ['class'=>'form-control' . ($errors->has('menu_title_ru') ? ' is-invalid' : ''), 'required' => true]) !!}
                            @if ($errors->has('menu_title_ru'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('menu_title_ru') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('description_ru', 'Описание', ['class' => 'col-form-label']); !!}
                            {!! Form::textarea('description_ru', old('description_ru', $news ? $news->description_ru : null),
                                ['class' => 'form-control' . ($errors->has('description_uz') ? ' is-invalid' : ''), 'id' => 'description_ru', 'rows' => 10]); !!}
                            @if ($errors->has('description_ru'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('description_ru') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('content_ru', 'Содержание', ['class' => 'col-form-label']); !!}
                            {!! Form::textarea('content_ru', old('content_ru', $news ? $news->content_ru : null),
                                ['class' => 'form-control ckeditor' . ($errors->has('content_ru') ? ' is-invalid' : ''), 'id' => 'content_ru', 'rows' => 10]); !!}
                            @if ($errors->has('content_ru'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('content_ru') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-green card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('status', 'Статус', ['class' => 'col-form-label']); !!}
                            {!! Form::select('status', \App\Entity\News::getStatusList(), old('status', $news ? $news->status : null),
                                    ['class'=>'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'required' => true]) !!}
                            @if ($errors->has('status'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('status') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $news ? 'Редактировать' : 'Добавить' }}</button>
</div>

@section($javaScriptSectionName)
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        // CKEDITOR.replace('content_uz');
        // CKEDITOR.replace('content_ru');
    </script>
@endsection
