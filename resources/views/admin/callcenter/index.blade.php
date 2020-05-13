@extends('adminlte::page')
@section('title','Пользователи')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Пользователи') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">{{ __('Главная') }} </a></li>
                <li class="breadcrumb-item active">{{ __('Пользователи') }}</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-footer">
                    <a class="btn btn-success" href="{{ route("admin.users.create") }}">{{ __('Добавить') }} </a> 
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card-body">
                        <form action="?" method="GET">
                            <div class="row">
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="city" class="col-form-label">{{ __('Город') }}</label>
                                        <select name="city" id="city" class="form-control input-lg dynamic" data-dependant='city' >
                                            <option value="">Shaxarni Tanla</option>
                                            @foreach ($cities as $value)
                                            <option value="{{ $value->name_ru}}">{{ $value->name_ru }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </br>
                                    <div class="form-group">
                                        <label for="district" class="col-form-label">{{ __('Tuman') }}</label>
                                        <select name="district" id="district" class="form-control input-lg dynamic" data-dependant='district' >
                                            <option value="">Tumanni Tanla</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label class="col-form-label">&nbsp;</label><br />
                                        <button type="submit" class="btn btn-primary">Поиск</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending";>{{ __('ID') }}</th>
                                <th>{{ __('Имя') }}</th>
                                <th>{{ __('Фамилия') }}</th>
                                <th>{{ __('Телефон') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Роль') }}</th>
                                <th>{{ __('Статус') }}</th>
                                <th style="width: 15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                                <td class="project-actions text-right">
                                    <div class="btn-group">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.users.show',$user->id)}}">
                                            <i class="fas fa-eye">
                                            </i>

                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit',$user->id)}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>

                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <form action="{{ route('admin.users.destroy', $user->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Вы уверены?')">
                                                <i class="fas fa-trash">
                                                </i>
                                            </button>
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
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @stop
    @section('script')
    $('dynamic').change(function(){
        if($(this).val() != ''){
        var select = $(this).attr("id");
        var value = $(this).val();
        var dependent = $(this).data('dependent');
        var_token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ route('admin.callcenter.fetch') }}",
            method:"POST",
            data:{select:select,value:value,_token:_token,dependent:dependent},
            success:function(result){
                $('#'+dependent).html(result);
            }
        })
        }
    }    )
    
    @stop