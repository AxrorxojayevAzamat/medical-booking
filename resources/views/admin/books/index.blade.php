@extends('adminlte::page')

@section('content')
<div class="container-fluid">
    <div class="box_general">
        <div class="header_box">
            <h2 class="d-inline-block">Bookings List</h2>
            <div class="filter">
                <select name="orderby" class="selectbox">
                    <option value="Any status">Any status</option>
                    <option value="Approved">Approved</option>
                    <option value="Pending">Pending</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
        </div>
        <div class="list_general">
            <ul>
                @foreach($bookingList as $book)
                <li>
                    <figure><img src="img/avatar1.jpg" alt=""></figure>
                    <h4>{{$book->user_id}} <i class="pending">Pending</i></h4>
                    <ul class="booking_details">
                        <li><strong>Booking date</strong> 11 November 2017</li>
                        <li><strong>Booking time</strong> 10.20AM</li>
                        <li><strong>Visits</strong> Cardiology test, Diabetic diagnose</li>
                        <li><strong>Telephone</strong> 0043 432324</li>
                        <li><strong>Email</strong> user@email.com</li>
                    </ul>
                    <ul class="buttons">
                        <li><a href="#0" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Approve</a></li>
                        <li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancel</a></li>
                    </ul>
                </li>
                @endforeach

            </ul>
        </div>
    </div>
    <!-- /box_general-->
    <nav aria-label="...">
        <ul class="pagination pagination-sm add_bottom_30">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
    <!-- /pagination-->
</div>
<!-- /container-fluid-->
@stop
@section('js')
<script>
    let a = @json($bookingList);
            console.log(a);



</script>

@stop