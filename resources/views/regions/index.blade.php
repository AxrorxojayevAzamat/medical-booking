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

    <br>
    <div class="container ">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Регионы, города и районы</h3>
                        <div class="row">
                            <form class="form-inline ml-5" action="{{route('region.index')}}">
                                <input class="form-control mr-sm-2" name="search" type="search" placeholder="поиск..."
                                       aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary my-2 my-sm-0" type="submit"><b><font color="black">Поиск</font></b>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 500px;">
                        <table class="table table-bordered table-hover ">
                            <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Название(узбекский)</th>
                                <th>Название(русский)</th>
                                <th>Родительский регион</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($regions as $region)
                                <tr>
                                    <td>{{$region->id}}</td>
                                    <td>{{$region->name_uz}}</td>
                                    <td>{{$region->name_ru}}</td>
                                    <td>{{$region->parent_id}}</td>
                                    <td class="text-center py-1 ">
                                        <div class="btn-group">
                                            <a href="{{ route('region.edit',['id'=>$region->id]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <form action="{{ route('region.destroy',['id'=>$region->id]) }}" method="post"
                                                  onsubmit="if(confirm('Точно удалить?')){return true} else {return false}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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



    @if(!isset($_GET['search']))
        {{$regions->links()}}
    @endif
@endsection

