@extends('layouts.admin.page')

@section('content')

@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{Session::get('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<h2>Страницы сайта</h2>
<div>
	<p>
	    <a class="btn btn-success" href="{{route('admin.pages.create')}}">Добавить</a>    
	</p>
	<div id="w0" class="grid-view">
	<table class="table table-striped table-bordered">
		<thead>
		<tr>
			<th>Кличка</th>
			<th>Название</th>
			<th>Обновлено</th>
			<th class="action-column">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
			@foreach($pages as $page)
			<tr>
				<td>{{$page->slug}}</td>
				<td>{{$page->title_ru}}</td>
				<td>{{$page->updated_at}}</td>
				<td>
					<a href="{{route('admin.pages.view',$page->id)}}">
						<span class="glyphicon glyphicon-list-alt"></span>
					</a>&nbsp;&nbsp;&nbsp;
					<a href="{{route('admin.pages.edit',$page->id)}}" options="{&quot;target&quot;:&quot;_blank&quot;}">
						<span class="glyphicon glyphicon-pencil"></span>
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
  </div>
</div>
@endsection