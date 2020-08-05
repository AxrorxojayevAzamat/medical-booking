
<div class="row add_bottom_45">
    <div class="col-lg-7">
        <div class="form-group">
            <div id="calendar{{$key}}"></div>
            <input type="hidden" id="my_hidden_input{{$key}}" name="calendar">
            <ul class="legend">
                <li><strong></strong>{{ trans('book.book_calendar_available') }}</li>
                <li><strong></strong>{{ trans('book.book_calendar_not_available') }}</li>
            </ul>
        </div>
    <div class="warning_time{{$key}}"><p style="color: #e74e84; margin: 0">{{trans('msg.validation_time')}}</p></div>
    <div class="warning_day{{$key}}"><p style="color: #e74e84; margin: 0">{{trans('msg.validation_day')}}</p></div>
    </div>
    <div class="col-lg-5">
        <ul class="time_select version_2 add_top_20" id="radio_times{{$key}}">

        </ul>
    </div>
</div>
<!-- /row -->
