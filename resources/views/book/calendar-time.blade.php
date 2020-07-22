
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
        <div class="warning_choose"></div>
    </div>
    <div class="col-lg-5">
        <ul class="time_select version_2 add_top_20 d-flex flex-wrap flex-column" id="radio_times{{$key}}" style="height: 350px; overflow: auto">

        </ul>
    </div>
</div>
<!-- /row -->
