@extends('layouts.region')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h2>Редактирование</h2></div>
                <div class="card-body">

                    <div class="card"><h3>Name_UZ</h3> {{ $regions->name_uz }}</div>
                    <div class="card"><h3>Name_UZ</h3> {{ $regions->name_ru }}</div>
                    <div class="card-author"><b>Автор : </b> {{ $post->name }}</div>

                    <div class="card-btn">
                        <a href="{{ route('regions.index') }}" class="btn btn-primary">На главную</a>
                        <a href="{{ route('regions.edit',['id'=>$region->id]) }}" class="btn btn-primary">Редактировать</a>
                    </div>
                    <form action="{{ route('regions.destroy',['id'=>$region->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-primary" value="Удалить">
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

