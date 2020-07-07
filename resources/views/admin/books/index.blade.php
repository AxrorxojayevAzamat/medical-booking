@extends('layouts.admin.page')

@section('css')
<link href="{{asset('css/admin.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
    <div class="box_general">
        <div class="header_box">
            <h2 class="d-inline-block">Bookings List</h2>
        </div>
        <div class="list_general">
            <ul>
                @foreach($bookingList as $book)
                <li>
                    <figure><img src="{{asset('img/avatar1.jpg')}}" alt=""></figure>
                    <h4>{{$book->user->profile->fullName}} 
                    {{--    
                        <i class="approved">{{ trans('Одобрено') }}</i>
                    --}}
                    </h4>
                    
                    <ul class="booking_details">
                        <li><strong>{{ trans('Дата бронирования') }}</strong>{{$book->booking_date}}</li>
                        <li><strong>{{ trans('Время бронирования') }}</strong>{{$book->time_start}}</li>
                        <li><strong>{{ trans('Описание') }}</strong>{{$book->descriptions}}</li>
                        <li><strong>{{ trans('Телефон') }}</strong>{{$book->user->phone}}</li>
                        <li><strong>{{ trans('Адрес электронной почты') }}</strong>{{$book->user->email}}</li>
                    </ul>
                </li>
                @endforeach

            </ul>
        </div>
    </div>
    <!-- /box_general-->
    <nav aria-label="...">
        <ul class="pagination pagination-sm add_bottom_30">
            {{ $bookingList->links() }}
        </ul>
    </nav>
    <!-- /pagination-->
</div>
<!-- /container-fluid-->
@stop
@section('js')
<!-- Bootstrap core JavaScript-->    
<!--<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>-->
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<!-- Page level plugin JavaScript-->
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('vendor/jquery.selectbox-0.2.js')}}"></script>
<script src="{{asset('vendor/retina-replace.min.js')}}"></script>
<script src="{{asset('vendor/jquery.magnific-popup.min.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('js/admin.js')}}"></script> 

@stop
