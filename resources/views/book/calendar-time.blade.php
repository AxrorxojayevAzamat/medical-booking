
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
        <div class="warning_time{{$key}}"></div>
        <div class="warning_day{{$key}}"></div>
    </div>
    <div class="col-lg-5">
        <ul class="time_select version_2 add_top_20" id="radio_times{{$key}}">

        </ul>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ trans('book.description') }}</label>
            <textarea class="form-control" name="description"  id="description" rows="3" required></textarea>
        </div>
    </div>
</div>
<!-- /row -->
