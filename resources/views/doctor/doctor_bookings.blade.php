@extends('doctor.base')

@section('content')

<div class="content-wrapper">
        <div class="container-fluid" style="margin-top: 50px">
            <h1 align="center">{{trans('menu.my_records')}}</h1>
            <div class="box_general padding_bottom">
              <table class="table">
                <thead>
                  <tr>
                    <th>{{trans('book.orderId')}}</th>
                    <th>{{trans('book.patient')}}</th>
                    <th>{{trans('doctors.clinic_name')}}</th>
                    <th>{{trans('book.booking_date')}}</th>
                    <th>{{trans('book.start_time')}}</th>
                    <th>{{trans('book.finish_time')}}</th>
                    <th>{{trans('book.description')}}</th>
                    <th>{{trans('book.payment')}}</th>
                    <th>{{trans('book.payment_status')}}</th>
                    <th>{{trans('book.attendance')}}</th>
                  </tr>
                </thead>
                <tbody>
            @foreach($bookings as $booking)
                  <tr>
                    <td>{{ $booking->id }}</td>                    
                    <td>
                        @if($booking->user->profile)
                        {{ $booking->user->profile->first_name.' '.$booking->user->profile->last_name }}
                        @endif
                    </td>
                        @if(Session::get('locale')=='ru')
                          <td>{{ $booking->clinic->name_ru }}</td>
                        @else
                          <td>{{ $booking->clinic->name_uz }}</td>
                        @endif
                    <td>{{ $booking->booking_date }}</td>
                    <td>{{ $booking->time_start }}</td>
                    <td>{{ $booking->time_finish }}</td>
                    <td>{{ $booking->description }}</td>
                    <td> 
                      @if($booking->payment_type=='1') 
                        <span>Payme</span>
                      @else 
                        <span>Click</span>
                      @endif
                    </td>   
                    <td class="project-state">
                      @if($booking->status=='1')
                        <span class="badge badge-secondary">{{trans('payment.waiting')}}</span>
                      @elseif($booking->status=='3') 
                        <span class="badge badge-primary">{{trans('payment.active')}}</span>
                      @elseif($booking->status=='4') 
                        <span class="badge badge-danger">{{trans('payment.cancelled')}}</span>
                      @elseif($booking->status=='5') 
                        <span class="badge badge-info">{{trans('payment.postponed')}}</span>
                      @elseif($booking->status=='10') 
                        <span class="badge badge-success">{{trans('payment.completed')}}</span>
                      @endif
                    </td>
                    <td>
                        @if($booking->order_status==1)
                          {{ trans('book.success') }}
                        @elseif($booking->order_status==2)
                          {{ trans('book.client') }}
                        @elseif($booking->order_status==3)
                          {{ trans('book.doctor') }}
                        @endif
                    </td>
                  </tr>
            @endforeach
                </tbody>
              </table>
              <br>
        </div>
        <!-- /.container-fluid-->
    </div>
  </div>

@stop