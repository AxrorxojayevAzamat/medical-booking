@extends('layouts.admin.page')

@section('content')
<p><a href="{{ route('admin.partners.create') }}" class="btn btn-success">Добавить</a></p>
<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-hover ">
            <thead>
            <tr align="center">
                <th>ID</th>
                <th>Название</th>
                <th>Cсылка</th>
                <th>Очередь</th>
                <th>Сортировка</th>    
                <th>Изображение</th>    
            </tr>
            </thead>
            <tbody>
            @foreach($partners as $partner)
                <tr>
                    <td class="text-center py-1 "><a href="{{ route('admin.partners.show', $partner) }}">{{ $partner->id }}</a></td>
                    <td class="text-center py-1 "><a href="{{ route('admin.partners.show', $partner) }}">{{ $partner->name }}</a></td>
                    <td class="text-center py-1 "><a href="{{ route('admin.partners.show', $partner) }}">{{ $partner->site_url }}</a></td>
                    <td class="text-center py-1 "><a href="{{ route('admin.partners.show', $partner) }}">{{ $partner->sort }}</a></td>
                    <td class="text-center py-1 ">
                        <div class="d-flex flex-row">
                            <form method="POST" action="{{ route('admin.partners.first', ['partner' => $partner]) }}" class="mr-1">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-double-up"></span></button>
                            </form>
                            <form method="POST" action="{{ route('admin.partners.up', ['partner' => $partner]) }}" class="mr-1">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-up"></span></button>
                            </form>

                            <form method="POST" action="{{ route('admin.partners.down', ['partner' => $partner]) }}" class="mr-1">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-down"></span></button>
                            </form>
                            <form method="POST" action="{{ route('admin.partners.last', ['partner' => $partner]) }}" class="mr-1">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-double-down"></span></button>
                            </form>
                        </div>

                    </td>
                    <td class="text-center py-1 "> <img src="{{ $partner->fileThumbnail}}"></td>
                </tr>
                
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection