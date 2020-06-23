@extends('adminlte::page')

@section('content')

<div class="tab-content">
    <div class="tab-pane fade show active" id="book" role="tabpanel" aria-labelledby="book-tab">
        <p class="lead add_bottom_30">{{ __('Расписание доктора') }} </p>
        <form method="GET" action="{{ route('admin.call-center.booking', [$user1, $clinic1]) }}" >
            <div class="main_title_3">
                <h3><strong>1</strong>{{ __('Выберите вашу дату') }}</h3>
            </div>
            <div class="form-group add_bottom_45">
                <div id="calendar"></div>
                <input type="hidden" id="my_hidden_input">
                <ul class="legend">
                    <li><strong></strong>{{ __('Доступный') }}</li>
                    <li><strong></strong>{{ __('Недоступен') }}</li>
                </ul>
            </div>
            <div class="main_title_3">
                <h3><strong>2</strong>{{ __('Выберите') }}</h3>
            </div>
            <div class="row justify-content-center add_bottom_45">
                <div class="col-md-12">
                    <ul class="time_select">
                        <li>
                            <input type="radio" id="radio1" name="radio_time" value="12:00">
                            <label for="radio1">12:00</label>
                        </li>                                            

                    </ul>
                </div>

            </div>
            <!-- /row -->

            <div class="main_title_3">
                <h3><strong>3</strong>{{ __('Выберите услугу') }}</h3>
            </div>
            <ul class="treatments clearfix">
                <li>
                    <div class="checkbox">
                        <input type="checkbox" class="css-checkbox" id="visit1" name="visit1">
                        <label for="visit1" class="css-label">{{ __('Визит боли в спине') }} <strong>$55</strong></label>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                        <input type="checkbox" class="css-checkbox" id="visit2" name="visit2">
                        <label for="visit2" class="css-label">{{ __('Сердечно-сосудистый экран') }}<strong>$55</strong></label>
                    </div>
                </li>

            </ul>


            <hr>
            <p class="text-center"><button class="btn_1 medium" type="submit">{{ __('Забронируйте сейчас') }}</button></p>
        </form>					
    </div>
    <!-- /tab_1 -->
</div>
<!-- /tab-content -->
@stop
@section('js')
<script>
    let doctorTime = @json($doctorTimetable);
            console.log(doctorTime);

    let celebration = @json($celebration);
    console.log(celebration);


    $('#calendar').datepicker({
        todayHighlight: true,
        daysOfWeekDisabled: [0],
        weekStart: 1,
        format: "yyyy-mm-dd",
        datesDisabled: ['2020-06-25'],
    });



</script>
@stop
