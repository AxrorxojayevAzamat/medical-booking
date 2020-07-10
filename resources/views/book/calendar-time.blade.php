
<div class="row add_bottom_45">
    <div class="col-lg-7">
        <div class="form-group">
            <div id="calendar{{$key}}"></div>
            <input type="hidden" id="my_hidden_input{{$key}}" name="calendar">
            <ul class="legend">
                <li><strong></strong>{{ __('Доступный') }}</li>
                <li><strong></strong>{{ __('Недоступен') }}</li>
            </ul>
        </div>
    </div>
    <div class="col-lg-5">
        <ul class="time_select version_2 add_top_20" id="radio_times{{$key}}">

        </ul>
    </div>
</div>
<!-- /row -->
