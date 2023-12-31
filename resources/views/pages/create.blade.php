@extends('layouts.admin.page')

@section('content')
@if($errors)
@foreach($errors->all() as $error)
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <strong>{{$error}}</strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@endforeach
@endif
<h2>Добавить</h2>
<form action="{{route('admin.pages.store')}}" method="post">
	@csrf
	<label class="control-label" for="singlepage-slug">Slug</label>
	<input type="text" id="singlepage-slug" class="form-control" name="slug" aria-required="true" aria-invalid="true" value="{{old('slug')}}">

    <ul class="nav nav-tabs" role="tablist" style="margin-top: 5px">
        <li style="margin-right: 5px">
        	<button class="btn btn-primary" id="button_ru" type="button" onclick="toggle_ru()">Русский</button>
        </li>
        <li>
        	<button class="btn btn-primary" id="button_uz" type="button" onclick="toggle_uz()">Узбекский</button>
        </li>
    </ul>

    <div class="form-group" id="toggle_ru">
		<label class="control-label" for="singlepage-title_en">Название</label>
		<input type="text" id="singlepage-title_en" class="form-control" name="title_ru" aria-required="true" aria-invalid="false"  value="{{old('title_ru')}}">
		<label class="control-label" for="singlepage-title_en">Контент</label>
		<textarea class="form-control" id="summary-ckeditor-ru" name="content_ru">{{old('content_ru')}}</textarea>
	</div>

	<div style="display: none" class="form-group" id="toggle_uz">
		<label class="control-label" for="singlepage-title_en">Название</label>
		<input type="text" id="singlepage-title_en" class="form-control" name="title_uz" aria-required="true" aria-invalid="false" value="{{old('title_uz')}}">
		<label class="control-label" for="singlepage-title_en">Контент</label>
		<textarea class="form-control" id="summary-ckeditor-uz" name="content_uz">{{old('content_ru')}}</textarea>
	</div>
	<div class="form-group">
	    <button type="submit" class="btn btn-success">Добавить</button>    
	</div>
</form>

<script src="https://cdn.ckeditor.com/4.4.5/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'summary-ckeditor-ru' );
	CKEDITOR.replace( 'summary-ckeditor-uz' );
</script>

<script>
function toggle_ru() {
  document.getElementById('toggle_uz').style.display='none';
  document.getElementById('toggle_ru').style.display='block';
  document.getElementById('button_ru').style.opacity='70%';
  document.getElementById('button_uz').style.opacity='100%'; 
}
function toggle_uz() {
  document.getElementById('toggle_uz').style.display='block';
  document.getElementById('toggle_ru').style.display='none';
  document.getElementById('button_ru').style.opacity='100%';
  document.getElementById('button_uz').style.opacity='70%';
}
</script>

@endsection