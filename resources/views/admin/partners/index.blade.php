@extends('layouts.admin.page')

@section('content')
<p><a href="{{ route('admin.partners.create') }}" class="btn btn-success">Добавить</a></p>
<div class="card">
    <div class="card-body table-responsive p-0" style="height: 500px;">
        <table class="table table-bordered table-hover ">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Cсылка</th>
                <th>Cортировка</th>
                <th>Изображение</th>    
            </tr>
            </thead>
            <tbody>
            @foreach($partners as $partner)
                <tr>
                    <td class="text-center py-1 "><a href="{{ route('admin.partners.show', $partner) }}">{{ $partner->name }}</a></td>
                    <td class="text-center py-1 "></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection