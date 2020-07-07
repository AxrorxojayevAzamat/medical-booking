@extends('layouts.admin.page')

@section('content')
    <p><a href="{{ route('admin.regions.create') }}" class="btn btn-success">Добавить</a></p>

    <div class="card mb-4">
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::text('name', request('name'), ['class'=>'form-control', 'placeholder' => 'Название']) !!}
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Искать</button>
                            <a href="?" class="btn btn-outline-secondary">Очистить</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card">

        <div class="card-body table-responsive p-0" style="height: 500px;">
            <table class="table table-bordered table-hover ">
                <thead>
                <tr align="center">
                    <th>Название</th>
                    <th>Родительский регион</th>
                </tr>
                </thead>
                <tbody>
                @foreach($regions as $region)
                    <tr>
                        <td class="text-center py-1 "><a href="{{ route('admin.regions.show', $region) }}">{{ $region->name_ru }}</a></td>
                        <td class="text-center py-1 ">
                            @php($parentRegion = $region->parent)
                            @while($parentRegion)
                                <a href="{{ route('admin.regions.show', $parentRegion) }}">{{ $parentRegion->name_ru }}</a><br>
                                @php($parentRegion = $parentRegion->parent)
                            @endwhile
{{--                            <a href="{{ route('admin.regions.show', $region) }}">{{ $region->parent->name_ru }}</a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{$regions->links()}}

@endsection

