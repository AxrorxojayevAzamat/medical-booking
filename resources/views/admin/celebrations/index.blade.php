@extends('layouts.admin.page')

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif

    
    <div class="row">
        <div class="col-12 ">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.celebration.create') }}" class="btn btn-success btn-sm ">Добавить</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 500px;">
                    <table class=" table table-bordered table-hover ">
                        <thead>
                        <tr align="center">
                            <th>Название праздника(uz)</th>
                            <th>Название праздника(ru)</th>
                            <th>Дата</th>
                            <th>Дней</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($celebrations as $celebration)
                            <tr>
                                <td class="text-center py-1 ">{{$celebration->name_uz}}</td>
                                <td class="text-center py-1 ">{{$celebration->name_ru}}</td>
                                <td class="text-center py-1 ">{{$celebration->date}}</td>
                                <td class="text-center py-1 ">{{$celebration->quantity}}</td>
                                <td class="text-center py-1 ">
                                    <div class="btn-group ml-2 ">
                                        <a href="{{ route('admin.celebration.edit', $celebration) }}"
                                            class="btn btn-info btn-sm"> <i class="fas fa-pencil-alt"></i></a>
                                    </div>
                                    <div class="btn-group ">
                                        <form action="{{ route('admin.celebration.destroy',$celebration) }}"
                                                method="post"
                                                onsubmit="if(confirm('Точно удалить?')){return true} else {return false}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    


@endsection

