<h1>{{ trans('book.your_booking')}}</h1>
<p>
	<b>{{ trans('book.booking_date') }}</b> {{$date}}
</p>
<p>
	<b>{{ trans('book.booking_start_time') }}</b> {{$start_time}}
</p>
<p>
	<b>{{ trans('book.booking_finish_time') }}</b> {{$finish_time}}
</p>
<p>
	<b>{{ trans('book.name_of_doctor') }}</b> {{ $doctor }}
</p>
<p>
	<b>{{ trans('book.name_of_clinic') }}</b> {{ $clinic }}
</p>
<p>
	<b>{{ trans('book.booking_cost') }}</b> {{$price}} {{$currency}}
</p>
@if(!empty($link))
<p>
	<b>{{trans('book.payment_link') }}</b> {{$link}}
</p>
@endif
