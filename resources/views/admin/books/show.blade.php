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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection