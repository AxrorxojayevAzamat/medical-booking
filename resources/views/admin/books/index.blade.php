@extends('layouts.admin.page')

@if (!config('adminlte.enabled_laravel_mix'))
@php($cssSectionName = 'css')
@php($javaScriptSectionName = 'js')
@else
@php($cssSectionName = 'mix_adminlte_css')
@php($javaScriptSectionName = 'mix_adminlte_js')
@endif

@section($cssSectionName)
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form action="?" method="GET">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="full_name" class="col-form-label">{{ trans('Имя, Фамилия пациента') }}</label>
                                <input id="full_name" class="form-control" name="full_name" value="{{ request('full_name') }}">
                                @if ($errors->has('full_name'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('full_name') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="booking_date" class="col-form-label">{{ trans('Дата бронирования') }}</label>
                                <input class="form-control" name="booking_date" type="date" value="{{ request('booking_date') }}">
                            </div>
                        </div>
                       
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="time_start" class="col-form-label">{{ trans('Время бронирования') }}</label>
                                <div class="input-group date" id="timepicker" data-target-input="nearest">
                                    <input type="time" name="time_start" class="form-control datetimepicker-input" data-target="#timepicker" value="{{ request('time_start')}}">
                                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="far fa-clock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="phone" class="col-form-label">{{ trans('Телефон') }}</label>
                                <input id="phone" class="form-control" name="phone" value="{{ request('phone') }}">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="col-form-label">&nbsp;</label><br />
                                <button type="submit" class="btn btn-primary">Поиск</button>
                                <a href="?" class="btn btn-danger">{{ __('Очистить') }}</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="bookings" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('Полное имя пациента') }}</th>
                            <th>{{ trans('Дата бронирования') }}</th>
                            <th>{{ trans('Время бронирования') }}</th>
                            <th>{{ trans('Конец времени') }}</th>
                            <th>{{ trans('Телефон пациента') }}</th>
                            <th>{{ trans('Полное имя доктора') }}</th>
                            <th>{{ trans('Название клиники') }}</th>
                            <th>{{ trans('Статус заказа') }}</th>
                            <th>{{ trans('Подробнее о заказе') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookingList as $book)
                        <tr>
                            <td><a href="{{ route('admin.users.show', $book->user->id) }}">{{ $book->user->profile ? $book->user->profile->fullName : '' }}</a></td>
                            <td>{{$book->booking_date}}</td>
                            <td>{{$book->time_start ? \Carbon\Carbon::parse($book->time_start)->format('H:i') : ''}}</td>
                            <td>{{$book->time_finish ? \Carbon\Carbon::parse($book->time_finish)->format('H:i') : ''}}</td>
                            <td>{{$book->user->phone}}</td>
                            <td><a href="{{ route('admin.users.show', $book->doctor->id) }}">{{ $book->doctor->profile ? $book->doctor->profile->fullName : '' }}</a></td>
                            <td><a href="{{ route('admin.clinics.show', $book->clinic->id) }}">{{ $book->clinic->name ? $book->clinic->name : '' }}</a></td>
                            <td>
                                <select name="order_status" onchange="location = this.value;" >
                                    <option value="{{route('admin.books.orderStatus',['id'=>$book->id,'order_status'=>1])}}" {{$book->order_status=='1'?'selected':''}}>Успешный</option>
                                    <option value="{{route('admin.books.orderStatus',['id'=>$book->id,'order_status'=>2])}}" {{$book->order_status=='2'?'selected':''}}>Клиент не пришел</option>
                                    <option value="{{route('admin.books.orderStatus',['id'=>$book->id,'order_status'=>3])}}" {{$book->order_status=='3'?'selected':''}}>Доктор не пришел</option>
                                </select>
                            </td>
                            {{-- @if ($book->type == \App\Entity\Book::PAYME)
                            <td>{!! $book->payme->stateName() !!}</td>
                            @elseif ($book->type == \App\Entity\Book::CLICK)
                                <td>{!! $book->click->statusName() !!}</td>
                            @else
                                <td>Оплачен (бесплатный номер)</td>
                            @endif --}}
                            <td><a href="{{ route('admin.books.show', $book) }}">Подробнее</a></td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>
                {{ $bookingList->links() }}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@stop
@section($javaScriptSectionName)

<!-- DataTables -->
<script src="{{asset('vendor/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendor/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<!-- page script --> 
<script>
$(function () {
    $('#bookings').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });
});

</script> 
@stop
