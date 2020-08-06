@extends('layouts.admin.page')

@if (!config('adminlte.enabled_laravel_mix'))
    @php($cssSectionName = 'css')
    @php($javaScriptSectionName = 'js')
@else
    @php($cssSectionName = 'mix_adminlte_css')
    @php($javaScriptSectionName = 'mix_adminlte_js')
@endif

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body p-0">
                <table id="laravel_datatable" class="table table-bordered table-striped">
                    <tbody>
                        <tr><th>ID заказа</th><td>{!! $book->id !!}</td></tr>
                        <tr><th>Дата бронирования</th><td>{!! $book->booking_date !!}</td></tr>
                        <tr><th>ФИО пациента</th><td>{!! $book->user->profile->fullName !!}</td></tr>
                        <tr><th>ФИО врача</th><td>{!! $book->doctor->profile->fullName !!}</td></tr>
                        <tr><th>Клиника</th><td>{!! $book->clinic->name !!}</td></tr>
                        <tr><th>Начало времени бронирования</th><td>{!! $book->time_start !!}</td></tr>
                        <tr><th>Конец времени бронирования</th><td>{!! $book->time_finish !!}</td></tr>
                        <tr><th>Комментарий</th><td>{!! $book->description !!}</td></tr>
                        <tr><th>Заказ создан</th><td>{!! $book->created_at !!}</td></tr>
                        {{-- @if ($book->payment_type == \App\Entity\Book\Book::PAYME)
                            <td>{!! $book->payme->stateName() !!}</td> --}}
                        {{-- @elseif ($book->type == \App\Entity\Book\Book::CLICK)
                            <td>{!! $book->click->getStatusName() !!}</td> --}}
                        {{-- @endif --}}
                        {{-- <tr><th>Тип платежа</th><td>{!! $book-> !!}</td></tr> --}}

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection