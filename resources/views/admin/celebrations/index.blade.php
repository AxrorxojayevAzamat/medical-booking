@extends('adminlte::page')
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

    <div class="container ">
        <div class="row">
            <div class="col-10 offset-md-1">
                <div class="card">
                    <div class="card-header" align="center">
                        <h3 >Праздничные дни</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 500px;">
                        <table class=" table table-bordered table-hover ">
                            <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Дата</th>
                                <th>Дней</th>
                                <th>Название праздника</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($celebrations as $celebration)
                                <tr>
                                    <td class="text-center py-1 ">{{$celebration->id}}</td>
                                    <td class="text-center py-1 ">{{$celebration->date}}</td>
                                    <td class="text-center py-1 ">{{$celebration->quantity}}</td>
                                    <td class="text-center py-1 ">{{$celebration->name}}</td>
                                    <td class="text-center py-1 ">
                                        <div class="btn-group ml-2 ">
                                            <a href="{{ route('celebration.edit',['id'=>$celebration->id]) }}"
                                               class="btn btn-info btn-sm"> <i class="fas fa-pencil-alt"></i></a>
                                        </div>
                                        <div class="btn-group ">
                                            <form action="{{ route('celebration.destroy',['id'=>$celebration->id]) }}"
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
    </div>


@endsection

