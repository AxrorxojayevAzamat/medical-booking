@extends('layouts.admin.page')

@section('content')
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.clinics.contacts.edit', ['clinic' => $clinic, 'contact' => $contact]) }}" class="btn btn-primary mr-1">Редактировать</a>
        <form method="POST" action="{{ route('admin.clinics.contacts.destroy', ['clinic' => $clinic, 'contact' => $contact]) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">Основной</h3></div>
                <div class="card-body">
                    <table class="table {{--table-bordered--}} table-striped projects">
                        <tbody>
                        <tr><th>ID</th><td>{{ $contact->id }}</td></tr>
                        <tr><th>Тип</th><td>{{ $contact->getTypeName() }}</td></tr>
                        <tr><th>Значение</th><td>{{ $contact->value }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @can('admin-panel')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning card-outline">
                    <div class="card-header"><h3 class="card-title">Другие</h3></div>
                    <div class="card-body">
                        <table class="table {{--table-bordered--}} table-striped projects">
                            <tbody>
                            <tr><th>Добавил</th><td>{{ $contact->createdBy->email }}</td></tr>
                            <tr><th>Редактировал</th><td>{{ $contact->updatedBy->email }}</td></tr>
                            <tr><th>Добавлено</th><td>{{ $contact->created_at }}</td></tr>
                            <tr><th>Редактировано</th><td>{{ $contact->updated_at }}</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
