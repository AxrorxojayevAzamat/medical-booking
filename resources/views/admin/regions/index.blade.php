@extends('adminlte::page')
@section('title','Регионы')
@section('content_header')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Регионы</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="http://localhost:8081/home">Главная </a></li>
                        <li class="breadcrumb-item active">Список регионов</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@stop
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

    @if(session('dangerous'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('dangerous') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif

    <div class="container ">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица регионов, городов и районов</h3>
                        <div class="row">
                            <form class="form-inline ml-3" action="{{route('region.index')}}">
                                <input class="form-control " name="search" type="search" placeholder="Поиск по имени..."
                                       aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary " type="submit"><i class="fas fa-search"></i>
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
                                    <td class="text-center py-1 ">{{$region->id}}</td>
                                    <td class="text-center py-1 ">{{$region->name_uz}}</td>
                                    <td class="text-center py-1 ">{{$region->name_ru}}</td>
                                    <td class="text-center py-1 ">
                                        @if($region->parent_id==0)
                                            Нет
                                        @endif
                                        @if(($region->parent_id!=0))

                                            @foreach($categories as $cat)
                                                @if($cat->id==$region->parent_id)
                                                    <option>{{$cat->name_ru}}</option>
                                                @endif
                                            @endforeach

                                            @foreach($categories as $cat)
                                                @foreach($cat->children($cat->id) as $item)
                                                    @if($item->id==$region->parent_id)
                                                        <option value="{{$item->id}}">{{$item->name_ru}}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach

                                        @endif
                                    </td>
                                    <td class="text-center py-1 ">
                                        @if(($region->parent_id==0))
                                            <div class="btn-group ml-2 ">
                                                <a href="{{ route('region.edit',['id'=>$region->id]) }}"
                                                   class="btn btn-info btn-sm"> <i class="fas fa-pencil-alt"></i></a>
                                            </div>
                                        @endif
                                        @if(($region->parent_id!=0))
                                            @foreach($categories as $cat)
                                                @if($cat->id==$region->parent_id)
                                                    <div class="btn-group ml-2 ">
                                                        <a href="{{ route('region.editCity',['id'=>$region->id]) }}"
                                                           class="btn btn-info btn-sm"> <i
                                                                class="fas fa-pencil-alt"></i></a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif

                                        @if(($region->parent_id!=0))
                                            @foreach($categories as $cat)
                                                @foreach($cat->children($cat->id) as $item)
                                                    @if($item->id==$region->parent_id)
                                                        <div class="btn-group ml-2 ">
                                                            <a href="{{ route('region.editDistrict',['id'=>$region->id]) }}"
                                                               class="btn btn-info btn-sm"> <i
                                                                    class="fas fa-pencil-alt"></i></a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                        <div class="btn-group ">
                                            <form action="{{ route('region.destroy',['id'=>$region->id]) }}"
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



    @if(!isset($_GET['search']))
        {{$regions->links()}}

    @endif

@endsection

