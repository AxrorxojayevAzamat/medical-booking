@extends('layouts.admin.page')

@section('content')

<h2>{{$page->title_ru}}</h2>
<p>
    <a class="btn btn-primary" href="{{route('admin.pages.edit',$page->id)}}">Обновить</a>    
</p>
<table class="table table-striped table-bordered detail-view">
	<tbody>
		<tr>
			<th>Кличка</th>
			<td>{{$page->slug}}</td>
		</tr>
		<tr>
			<th>Обновлено</th>
			<td>{{$page->updated_at}}</td>
		</tr>
	</tbody>
</table>

<ul class="nav nav-tabs" role="tablist" style="margin-bottom: 10px">
    <li style="margin-right: 5px">
    	<button class="btn btn-primary" id="button_ru" type="button" onclick="toggle_ru()">Русский</button>
    </li>
    <li>
    	<button class="btn btn-primary" id="button_uz" type="button" onclick="toggle_uz()">Узбекский</button>
    </li>
</ul>
<div class="table">
	<div class="ru" id="toggle_ru">
		<table class="table table-striped table-bordered detail-view" >
		<tbody>
			<tr>
				<th style="width: 10%">Название</th>
				<td>{{$page->title_ru}}</td>
			</tr>
			<tr>
				<th>Контент</th>
				<td>{!!$page->content_ru!!}</td>
			</tr>
		</tbody>
		</table>
	</div>
	<div style="display: none;" class="uz" id="toggle_uz">
		<table class="table table-striped table-bordered detail-view" >
			<tbody>
				<tr>
					<th style="width: 10%">Название</th>
					<td>{{$page->title_uz}}</td>
				</tr>
				<tr>
					<th>Контент</th>
					<td>{!!$page->content_uz!!}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

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