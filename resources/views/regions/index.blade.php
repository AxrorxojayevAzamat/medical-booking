@extends('layouts.region')
@section('content')

    <div class="row">
        @foreach($regions as $region)
            <div class="col-6">
                <div class="card">
                    <div class="card-header"><h2>Регионы</h2></div>
                    <div class="card-body">
                        <div class="card"><b>Название</b> <i>{{ $region->name_uz }}</i></div>
                        <div class="card"><b>Название</b> <i>{{ $region->name_ru }}</i></div>
                        <a href="{{ route('$regions.show',['id'=>$region->id]) }}" class="btn btn-primary">Посмотреть</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection





{{--<form action="{{ route('regions.store') }}"method="post" enctype="multipart/form-data">--}}
{{--    @csrf--}}

{{--    <div class="col-md-12" >--}}
{{--        <div class="card card" >--}}
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title"><p align="center">Поиск</p></h3>--}}
{{--            </div>--}}

{{--            <form role="form">--}}
{{--                <div class="card card-group" >--}}
{{--                <div class="col-sm-2">--}}
{{--                    <!-- select -->--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Регионы</label>--}}
{{--                        <select class="form-control">--}}
{{--                            <option>Ташкентская область</option>--}}
{{--                            <option>Самаркандская область</option>--}}
{{--                            <option>Андижанская область</option>--}}
{{--                            <option>Бухарская область</option>--}}
{{--                            <option>Хивинская область</option>--}}
{{--                        </select>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-2">--}}
{{--                    <!-- select -->--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Города</label>--}}
{{--                        <select class="form-control">--}}
{{--                            <option>Ташкент</option>--}}
{{--                            <option>Самарканд</option>--}}
{{--                            <option>Андижан</option>--}}
{{--                            <option>Бухара</option>--}}
{{--                            <option>Хива</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-2">--}}
{{--                    <!-- select -->--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Районы</label>--}}
{{--                        <select class="form-control">--}}
{{--                            <option>Чиланзарский</option>--}}
{{--                            <option>Мирабадский</option>--}}
{{--                            <option>Учтепинский</option>--}}
{{--                            <option>Алмазарский</option>--}}
{{--                            <option>Яшнабадский</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <button type="submit" class="btn btn-primary">Поиск</button>--}}
{{--                </div>--}}
{{--            </form>--}}

{{--        </div>--}}
{{--    </div>--}}

{{--</form>--}}

