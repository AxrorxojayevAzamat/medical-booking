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
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header" align="center">
                        <h3 >Клиники и поликлиники</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 500px;">
                        <table class=" table table-bordered table-hover ">
                            <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Адресс</th>
                                <th>Телефон</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clinics as $clinic)
                                <tr>
                                    <td class="text-center py-1 ">{{$clinic->id}}</td>
                                    <td class="text-center py-1 ">{{$clinic->name_ru}}</td>
                                    <td class="text-center py-1 ">{{$clinic->description_ru}}</td>
                                    <td class="text-center py-1 ">{{$clinic->adress_ru}}</td>
                                    <td class="text-center py-1 ">{{$clinic->phone_numbers}}</td>
                                    <td class="text-center py-1 ">
                                        <div class="btn-group ml-2 ">
                                            <a href="{{ route('clinic.edit',['id'=>$clinic->id]) }}"
                                               class="btn btn-info btn-sm"> <i class="fas fa-pencil-alt"></i></a>
                                        </div>
                                        <div class="btn-group ">
                                            <form action="{{ route('clinic.destroy',['id'=>$clinic->id]) }}"
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
